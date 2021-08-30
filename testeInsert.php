<?php
require_once  "vendor/autoload.php";
//rodar pelo menos uma vez o example.php
use Data\Db\getDatadb;
// include_once "conn_example.php";
include_once "conn.php";
$agora = date('d/m/Y H:i:s');
echo $agora;
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
// $data = [
//     "name"=>"nameteste",
//     "ip"=>rand(1,254).".".rand(1,254).".".rand(1,254).".".rand(1,254),
//     "num"=>rand(1,5)
// ];
$request = (object)[];
$request->data = [
    "name"=>"nameteste".rand(1,5), //coluna = valor
    "num"=>rand(1,5)
];
$request->options = [
    "LIMIT"=>"100"//coluna = valor
    // "Desc"=>""
];
echo "\n";
$data = (object)[];
$data->item = [];

for($i=1;$i<=1000;$i++){
    $item = [
        "name"=>"nameteste 3",
        "ip"=>rand(1,254).".".rand(1,254).".".rand(1,254).".".rand(1,254),
        "num"=>rand(1,5)
    ];
    // echo $i;
    $data->item[$i] = $item;
}
echo "\n";
$agora = date('d/m/Y H:i:s');
echo $agora;
foreach($data->item as $data){
   echo $getDB->insertData_pro($data,$conn->table);
    // echo "\n";
}
echo "\n";
$agora = date('d/m/Y H:i:s');
echo $agora;
echo json_encode($getDB->getData_pro($request,$conn->table));//pega o retorno da tabela, OBS: options query funcionam
echo "\n";
$agora = date('d/m/Y H:i:s');
echo $agora;
?>