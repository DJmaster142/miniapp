<?php

include '../../bot/config.php';
include '../../bot/functions.php';

$MySQLi = new mysqli('localhost',$DB['username'],$DB['password'],$DB['dbname']);
$MySQLi->query("SET NAMES 'utf8'");
$MySQLi->set_charset('utf8mb4');
if ($MySQLi->connect_error) die;
function ToDie($MySQLi){
$MySQLi->close();
die;
}


session_start();
$app_hash = $_SESSION['app_hash'];

$get_user = mysqli_fetch_assoc(mysqli_query($MySQLi, "SELECT * FROM `users` WHERE `hash` = '{$app_hash}' LIMIT 1"));

if(!$get_user){
    http_response_code(300);
    echo json_encode(['ok' => false, 'message' => 'user not found'], JSON_PRETTY_PRINT);
    $MySQLi->close();
    die;
}


$tappingGuruLeft = $get_user['tappingGuruLeft'];
if(microtime(true) * 1000 >= $get_user['tappingGuruNextTime']){
    if($tappingGuruLeft >= 3){
        $tappingGuruLeft = 3;
    }else{
        $tappingGuruLeft++;
    }
}


$tappingGuruLeft--;
if($tappingGuruLeft < 0){
    http_response_code(300);
    echo json_encode(['ok' => false, 'message' => 'user not found'], JSON_PRETTY_PRINT);
    $MySQLi->close();
    die;
}

$tappingGuruNextTime = microtime(true) * 1000 + (6 * 60 * 60 * 1000);
$tappingGuruStarted = microtime(true) * 1000;
$MySQLi->query("UPDATE `users` SET `tappingGuruStarted` = '{$tappingGuruStarted}' ,`tappingGuruLeft` = '{$tappingGuruLeft}', `tappingGuruNextTime` = '{$tappingGuruNextTime}' WHERE `hash` = '{$app_hash}' LIMIT 1");


$MySQLi->close();