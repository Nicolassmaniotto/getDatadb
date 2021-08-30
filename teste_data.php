<?php
require_once  "vendor/autoload.php";
use Data\Db\getDatadb;
include_once "conn_example.php";
include_once "conn.php";
$conn->table = 'users';
$getDB = new getDatadb;
$getDB->conn = $conn;
$base = [
    "id"=>" INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "name"=>"",
    "ip"=>"",
    "num"=>"INT(20)",
    "c_timestamp"=>"TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP"
];
$data = [
    "name"=>"nameteste",
    "ip"=>rand(1,254).".".rand(1,254).".".rand(1,254).".".rand(1,254),
    "num"=>rand(1,5)
];
$request = (object)[];
$request->data = [
    "name"=>"nameteste"//coluna = valor
];
$request->options = [
    "LIMIT"=>"10"//coluna = valor
];
$type=['s','s','i'];
$type_req =["s"];
echo "createDatabase: ". $getDB->createDatabase($conn); //Cria database
echo "\n";
echo "createTable: ".$getDB->createTable($base,$conn->table); //cria a tabela
echo "\n";
// echo "inertData: ". $getDB->insertData($data,$conn->table,$type); //insere na tabela, em caso de erro revisar a construção da tabela, e tamanho do int
// echo "\n";
echo "insertData: ". $getDB->insertData_pro($data,$conn->table); //insere na tabela, em caso de erro revisar a construção da tabela, e tamanho do int
echo "\n";
echo "time: ".  $getDB->getCTimestamp(); // exemplo get current_timestamp db server
// echo "\n";
// echo "echo: "; echo $getDB->echoTest(); //imprime algo se teve acesso a classe
// echo "\n";
// echo json_encode($getDB->getData($request->data,$conn->table,$type_req));//pega o retorno da tabela, OBS: options query não funcionam
// echo "\n";
echo "\n";
echo json_encode($getDB->getData_pro($request,$conn->table));//pega o retorno da tabela, OBS: options query funcionam
?>