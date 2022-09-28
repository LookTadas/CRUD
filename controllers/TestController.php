<?php
include "./db/Test.php";

class TestController {
// this calls function witch creates array for index
    public static function index(){
        $tests = Test::all();
        return $tests;
    }
// calls function whitch calls specific array
    public static function show (){
        $test = Test::find($_POST["id"]);
        return $test;
    }

    public static function store (){

        Test::create();
        
    }

    public static function edit (){
        
    }
// calls function to update specific array
    public static function update (){
        $test = new Test();
        $test->id = $_POST["id"];
        $test->test1 = $_POST["test1"];
        $test->test2 = $_POST["test2"];
        $test->test3 = $_POST["test3"];
        $test->update();
    }


    public static function destroy (){
        Test::destroy($_POST["id"]);
    }
}

?>
