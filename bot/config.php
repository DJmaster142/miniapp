<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

date_default_timezone_set('Asia/Kolkata');
ini_set("log_errors", "off");
error_reporting(0);


$apiKey = '7004906817:AAG9A27SzomW06poO0jXnCBLHDSl53CjPW8';

$botUsername = 'the_GoatCoinBot';

$web_app = 'https://game.mygoatcoin.com';

$DB = [
'dbname' => 'chauhand_goat',
'username' => 'chauhand_goat',
'password' => 'chauhand_goat'
];

$admins_user_id = [
1362026193,
];