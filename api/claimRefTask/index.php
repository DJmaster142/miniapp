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
    http_response_code(422);
    echo json_encode(['ok' => false, 'message' => 'user not found'], JSON_PRETTY_PRINT);
    $MySQLi->close();
    die;
}


$refLevel = json_decode(file_get_contents('php://input'), true)['refLevel'];

if(mysqli_fetch_assoc(mysqli_query($MySQLi, "SELECT * FROM `refTasks` WHERE `user_id` = '{$get_user['id']}' AND `refLevel` = '$refLevel' LIMIT 1"))){
    http_response_code(422);
    echo json_encode(['ok' => false, 'message' => 'error'], JSON_PRETTY_PRINT);
    $MySQLi->close();
    die;
}

$ref_prize = array(
    "1" => 5000,
    "3" => 100000,
    "10" => 400000,
    "25" => 500000,
    "50" => 600000,
    "100" => 1000000,
    "500" => 2500000,
    "1000" => 4000000,
    "10000" => 10000000,
    "100000" => 100000000
);

if(!is_numeric($ref_prize[$refLevel])){
    $MySQLi->close();
    die;
}


$newBalance = $get_user['balance'] + $ref_prize[$refLevel];
$MySQLi->query("UPDATE `users` SET `balance` = '{$newBalance}' WHERE `hash` = '{$app_hash}' LIMIT 1");

$MySQLi->query("INSERT INTO `refTasks` (`user_id`, `refLevel`) VALUES ('{$get_user['id']}', '{$refLevel}')");


$MySQLi->close();