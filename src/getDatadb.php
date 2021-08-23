<?php
    namespace Data\Db;

use mysqli;

// use mysqli;

class getDatadb{
        public function connect_p($option){
            if(!isset($option->conn)){
                $conn = mysqli_connect($option->servername, $option->username, $option->password, $option->database);
            }else{
                $dataConn = $option->conn;
                $conn = mysqli_connect($dataConn->servername, $dataConn->username, $dataConn->password, $dataConn->database);

            }
            // $conn = mysqli_connect($option->servername, $option->username, $option->password, $option->database);
            return $conn;
        }
        public function connect_obj($array){
            if(!isset($array->conn)){
                $option = $array;
            }else{
                $option = $array->conn;
            }
            $mysqli = new mysqli($option->servername, $option->username, $option->password, $option->database);
            return $mysqli;
        }
        static function getDb($option){
            if(isset($option)){

            }
        }
        public function getCTimestamp(){//get current_timestamp of db
            $conn = $this->connect_p($this);
            $sql = "SELECT current_timestamp;";
            $result = mysqli_query($conn, $sql);
            $row   = mysqli_fetch_row($result);
            mysqli_close($conn);

            return $row[0];
        }
        public function createTable($data,$table){
            $conn = $this->connect_p($this);
            $count = count($data);
            $i = 0;
            $sql = "CREATE TABLE IF NOT EXISTS $table (";
            foreach($data as $key => $options){
                if(!isset($options) | $options == NULL){
                    $options .= "VARCHAR(30) NULL";
                };
                if($i <($count -1)){
                    $options .= ',';
                };
                $i++;
                $sql .="$key $options";
            }
            $sql.= ");";
            $result = mysqli_query($conn, $sql);
            // $row   = mysqli_fetch_row($result);
            mysqli_close($conn);
            return ( $result ? 'true' : 'false' ) ;
        }
        public function createDatabase($option){
            $conn =  mysqli_connect($option->servername, $option->username,$option->password);
            // $conn = $this->connect_p($this);
            $sql = "CREATE DATABASE IF NOT EXISTS $option->database ; ";
            // echo $sql;
            $result = mysqli_query($conn, $sql);
            // $row   = mysqli_fetch_row($result);
            mysqli_close($conn);
            return ( $result ? 'true' : 'false' ) ;
        }

        public function insertData($data,$table,$type){
            //Dont use big int 
            $mysqli = $this->connect_obj($this);
            $mysqli->set_charset("utf8mb4");
            $count = count($data);
            $i = 0;
            $s = "";
            $sql  = "INSERT INTO $table ( ";
            $val = [];
            foreach($data as $key => $value){
                $sql .=" $key";
                $val[$i]=$value;
                // var_dump($val[$i]);
                if($i <($count -1)){
                    $sql .= ',';
                };
                $i++;
            }
            $sql .= ") VALUES (";
            $i = 0;
            foreach($data as $key => $value){
                $sql .=" ? ";
                if($i <($count -1)){
                    $sql .= ',';
                };
                $i++;
            }
            $sql .= ");";
            $s = '';
            foreach($type as $type){
                $s .= "$type";
            }
            $stmt = $mysqli->prepare("$sql");
            $stmt->bind_param("$s",...$val);
            $stmt->execute();
            $result =  ($stmt->execute() ? 'true' : 'false');
            $stmt->close();
            return $result;
            
        }

        public function getData($data,$table,$type){
            //Dont use big int 
            $mysqli = $this->connect_obj($this);
            $mysqli->set_charset("utf8mb4");
            $count = count($data);
            $i = 0;
            $s = "";
            $sql  = "SELECT * FROM $table WHERE ";
            $val = [];
            foreach($data as $key => $value){
                $sql .="$key = ? ";
                $val[$i]= $value;
                $s .= ($type[$i])? $type[$i] : "s";
                // var_dump($val[$i]);
                if($i <($count -1)){
                    $sql .= '';
                };
                $i++;
            }
            $sql .= " ;";
            // echo $sql;
            // echo "\n";
            // echo $s;
            // echo "\n";
            // var_dump($val);
            $stmt = $mysqli->prepare("$sql");
            $stmt->bind_param("$s",...$val);
            // $stmt->bind_param("ss",$val[0],$val[1]);
            $stmt->execute();
            // $result =;
            $result = $stmt->get_result();
            
            $stmt->close();
            return $result;
            
        }
        static function echo_test(){
            echo   'connection successful';
        }
    }

?>