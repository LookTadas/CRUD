<?php
// Establishing connection with server
    class Db {
        public $con;

        public function __construct(){
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "test";
            $this->con = new mysqli($servername,$username,$password,$db);
        }
    }

?>