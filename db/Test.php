<?php
    include "./db/Db.php";
// creating variables 
    class Test{
        public $id;
        public $test1;
        public $test2;
        public $test3;

        public function __construct ($id = null, $test1 = null, $test2 = null, $test3 = null){
            $this->id = $id;
            $this->test1 = $test1;
            $this->test2 = $test2;
            $this->test3 = $test3;
        }
// function to take data form SQL servers with established variables
        public static function all(){
            $tests = [];
            $db = new Db();
            $sql = "SELECT * FROM `test_test`";
            $result = $db -> con -> query($sql);

            while ($row = $result -> fetch_assoc()){
                $tests[] = new Test($row["id"], $row["test1"], $row["test2"], $row["test3"]);
            }

            $db -> con -> close();
            return $tests;
        }
// function to create new line of array
        public static function create(){
            $db = new Db();
            $stmt = $db->con->prepare("INSERT INTO `test_test`(`test1`, `test2`, `test3`) VALUES (?,?,?)"); // <-- klaustukai be kabučių
            $stmt -> bind_param("isi", $_POST["test1"], $_POST["test2"], $_POST["test3"]); // <-- i = integer, s = text
            $stmt -> execute();
            $stmt -> close();
            $db-> con -> close();
        }
// finding specific database line (?) kas yra  fetch_assoc (?)
        public static function find($id){
            $shoe;
            $db = new Db();
            $result = $db->con->query("SELECT * FROM `test_test` WHERE `id` = " . $id);

            while ($row = $result->fetch_assoc()){
                $test = new Test($row["id"], $row["test1"],$row["test2"], $row["test3"]);
            }

            $db->con->close();
            return $test;
        }
// updates specific array line
        public static function update(){
            $db = new Db();
            $stmt = $db->con->prepare("UPDATE `test_test` SET `test1` = ? , `test2` = ?, `test3`= ? WHERE `id` = ?");
            $stmt -> bind_param("isii", $_POST["test1"], $_POST["test2"], $_POST["test3"], $_POST["id"]); // <-- i = integer, s = text, taip pat nepamiršti papildyti $_POST($id)
            $stmt -> execute();
            $stmt -> close();
            $db-> con -> close();
        }
// DESTROY ARRAY
        public static function destroy(){
            $db = new Db();
            $stmt = $db->con->prepare("DELETE FROM `test_test` WHERE `id` = ?");
            $stmt -> bind_param("i", $_POST["id"]); 
            $stmt -> execute();
            $stmt -> close();
            $db-> con -> close();
            
        }
    }
?>