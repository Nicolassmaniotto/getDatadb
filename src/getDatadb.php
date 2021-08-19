<?php
    namespace Data\Db;

use mysqli;

class getDatadb{
        // static function connect(){
        //     $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
        // }
        static function getDb($option){
            
        }
        public function getCTimestamp(){//get current_timestamp of db
            if(!isset($this->conn)){
                $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->database);
            }else{
                $dataConn = $this->conn;
                $conn = mysqli_connect($dataConn->servername, $dataConn->username, $dataConn->password, $dataConn->database);

            }
            $sql = "SELECT current_timestamp;";
            $result = mysqli_query($conn, $sql);
            $row   = mysqli_fetch_row($result);
            mysqli_close($conn);
            return $row[0];

            //$ssfullname = $row['ssfullname'];
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