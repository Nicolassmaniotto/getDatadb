<?php
    namespace Data\Db;

use mysqli;

// use mysqli;

class getDatadb{
        static function connect_p($option){
            if(!isset($option->conn)){
                $conn = mysqli_connect($option->servername, $option->username, $option->password, $option->database);
            }else{
                $dataConn = $option->conn;
                $conn = mysqli_connect($dataConn->servername, $dataConn->username, $dataConn->password, $dataConn->database);

            }
            // $conn = mysqli_connect($option->servername, $option->username, $option->password, $option->database);
            return $conn;
        }
        static function connect_obj($array){
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

        public function insertData($datas,$table,$type,$array = false){
            //Dont use big int 
            $mysqli = $this->connect_obj($this);
            $mysqli->set_charset("utf8mb4");
            // $count = count($data);
            $i = 0;
            $s = "";
            $sql  = "INSERT INTO $table ( ";
            $val = [];
            if($array == true | $array == 'true'){
                $data = $datas->data;
            }else{
                $data = $datas;
            }
            $count = count($data);
            foreach($data as $key => $value){
                $sql .=" $key";
                // $val[$i]=$value;
                $val[$i]= $mysqli->real_escape_string($value);
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
            // var_dump($val);
            // echo $sql;
            // echo $s;
            $stmt = $mysqli->prepare("$sql");
            if($array == true | $array == 'true'){
                foreach($datas->data as $key => $value){
                    $stmt->bind_param("$s",...$val);
                        // $stmt->execute();
                    echo $result .=  ($stmt->execute() ? 'true ' : 'false ');
                }
                return $result;
            }
            $stmt->bind_param("$s",...$val);
            // $stmt->execute();
            $result =  ($stmt->execute() ? 'true' : 'false');
            // $stmt->close();
            return $result;
            
            
        }     

        public function insertData_pro($data,$table){
            //não usar inteiros grandes, limitação de variaveis php, tamanho maximo varia de versão do php e arquitetura
            //Dont use big int 
            $count = count($data);
            $conn = $this->connect_p($this);
            $i = 0;
            $s = "";
            $sql  = "INSERT INTO $table ( ";
            $val = [];
            foreach($data as $key => $value){
                $sql .=" $key";
                if($i <($count -1)){
                    $sql .= ',';
                };
                $i++;
            }
            $sql .= ") VALUES (";
            $i = 0;
            foreach($data as $key => $value){
                $sql .= $this->prevSQL($conn,$value);
                // echo $this->prevSQL($conn,$value);
                // echo "\n";
                // echo "\n";
                if($i <($count -1)){
                    $sql .= ',';
                };
                $i++;
            }
            $sql .= ");";
            // var_dump($val);
            // echo $sql;
            $result = mysqli_query($conn, $sql);
            $result = ($result )? 'true' : 'false';
            // $stmt->close();
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
                // $sql .="$key ='".$mysqli->real_escape_string($value)."' ";
                // $val[$i]= $value;
                $val[$i]= $mysqli->real_escape_string($value);
                $s .= ($type[$i])? $type[$i] : "s";
                // var_dump($val[$i]);
                if($i <($count -1)){
                    $sql .= '';
                };
                $i++;
            }
            $sql .= " ;";
            $stmt = $mysqli->prepare("$sql");
            $stmt->bind_param("$s",...$val);
            $stmt->execute();
            // $result =;
            $result = $stmt->get_result();
            
            $all = $result->fetch_all(MYSQLI_ASSOC);

            // $current = $stmt->current();
            $stmt->close();
            
            return $all;
            
        }
        public function getData_pro($request,$table){
            $data = $request->data;
            $options = $request->options;
            $count = count($data);
            $conn = $this->connect_p($this);
            // $sql = "CREATE TABLE IF NOT EXISTS $table (";
            $sql = "SELECT * FROM $table WHERE ";
            $i = 0;
            foreach($data as $key => $value){
                    $sql .= "$key = ".$this->prevSQL($conn,$value)." "; // verfica,sanitiza, espaço vazio adicionado ao final
                
                if($i <($count -1)){
                    $sql .= " AND ";
                    // echo $value;
                };
                $i++;
            }
            $i=0;
            foreach($options as $key => $value){
                $sql .= "$key  ".mysqli_real_escape_string($conn,$value);
                if($i <($count -1)){
                    $sql .= ' ';
                };
                $i++;
            }
            $sql.= ";";
            $result = mysqli_query($conn, $sql);
            $all = mysqli_fetch_all ($result, MYSQLI_ASSOC);
            mysqli_close($conn);
            
            return $all;
        }
        static function prevSQL($conn,$var){ //controle automatico de variavel
            if(is_string($var)){
               return "'".mysqli_real_escape_string($conn,$var)."'";
            }elseif(is_nan($var)){
            }elseif(is_bool($var)){
                return $var;
            }elseif(is_numeric($var)){
                return $var;
            }else{
                return mysqli_real_escape_string($conn,$var);
            }
        }
        static function echoTest(){ //teste de requisição
            echo   ' Teste de conexão ';
        }
        static function JSON_header($data){
            header('Content-Type: application/json');
            // echo json_encode($data);    
        }
    }

?>