<?php
    namespace Data\Db;

use mysqli;

class getDatadb{
        public function connect($option){
            if(!isset($option->conn)){
                $conn = mysqli_connect($option->servername, $option->username, $option->password, $option->database);
            }else{
                $dataConn = $option->conn;
                $conn = mysqli_connect($dataConn->servername, $dataConn->username, $dataConn->password, $dataConn->database);

            }
            // $conn = mysqli_connect($option->servername, $option->username, $option->password, $option->database);
            return $conn;
        }
        static function getDb($option){
            if(isset($option)){

            }
        }
        public function getCTimestamp(){//get current_timestamp of db

            $conn = $this->connect($this->conn);
            $sql = "SELECT current_timestamp;";
            $result = mysqli_query($conn, $sql);
            $row   = mysqli_fetch_row($result);
            mysqli_close($conn);
            return $row[0];

            $ssfullname = $row['ssfullname'];
        }
        public function insertData(){
            $this->data;
            $this->db;
            $this->option;
        }
        static function echo_test(){
            echo   'echo test';
        }
    }

?>