<?php
require_once  "vendor/autoload.php";
use Data\Db\getDatadb;
$conn = (object)[
    'username'=>'', //your username for db access
    'servername'=>'',//your servel local exmple 'localhost'
    'password'=>'', //your password db
    'database'=>'' //your database example 'test'
];

$getDB = new getDatadb;
$getDB->conn = $conn;
echo $getDB->getCTimestamp(); // exemplo get current_timestamp db server

?>