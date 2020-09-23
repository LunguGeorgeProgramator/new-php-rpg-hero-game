<?php
    class DataBase {

        private $servername;
        private $username;
        private $password;
        private $dbname;

        function __construct() {
            $this->conn = false;
            $this->servername = "localhost";
            $this->username = "root";
            $this->password = "";
            $this->dbname = "hero_game";
            $this->connectDB();
        }

        function __destruct() {
            if($this->conn !== false){
                $this->conn->close(); 
            }
        }

        private function connectDB(){
            if($this->conn === false){
                $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
                if ($this->conn->connect_error) {
                    die("Connection failed: " .$this->conn->connect_error);
                }
            }
            return $this->conn;
        }

        // public function queryRun($query){
        //     return $this->conn->query($query);
        // }

        // public function playerDetails($row, $id){
        //     return (object) array_merge([
        //         'id' => $row["id"],
        //         'level' =>  $row["level"],
        //         'experience' => $row["experience"],
        //         'name' =>  $row["name"]
        //     ], $this->getAttributes($id));
        // }
    
        // public function runQuery($query){
        //     $result = $this->conn->query($query);
        //     if ($result->num_rows > 0) {
        //         while($row = $result->fetch_assoc()) {
        //             return $row;
        //         }
        //     } else {
        //         return [];
        //     }
        // }

        public function runQuery($query){
            $resultArray = [];
            $result = $this->conn->query($query);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    array_push($resultArray, $row);      
                }
                return $resultArray;
            } 
            return $resultArray;
        }

    }
