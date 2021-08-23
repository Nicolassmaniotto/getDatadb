<?php
require_once  "vendor/autoload.php";
use Data\Db\getDatadb;
$conn = (object)[
    'username'=>'', //your username for db access
    'servername'=>'',//your servel local exmple 'localhost'
    'password'=>'', //your password db
    'database'=>'' //your database, example 'test'
];
$conn->table = 'users';
$getDB = new getDatadb;
$getDB->conn = $conn;
$base = [
    "id"=>" INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "name"=>"",
    "ip"=>"",
    "c_timestamp"=>"TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP"
];
$data = [
    "name"=>"nameteste",
    "ip"=>"198.162.100.255",
];
$type=['s','s'];
echo $getDB->createDatabase($conn); //Cria database
echo "\n";
echo $getDB->createTable($base,$conn->table); //cria a tabela
echo "\n";
echo $getDB->insertData($data,'users',$type); //insere na tabela
echo "\n";
echo $getDB->getCTimestamp(); // exemplo get current_timestamp db server
?>