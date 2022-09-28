<?php
    include "./controllers/TestController.php";

    print_r($_GET);
    PRINT_R($_POST);
    print_r($_SERVER["REQUEST_METHOD"]);

    $edit = false;
// function callouts
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        if(isset($_POST["save"])) {
            TestController::store();
            header("location: ./index.php");
            die;
            
        }
        if(isset($_POST["edit"])) {
            $test = TestController::show();
            $edit = true;
            
        }
        if(isset($_POST["update"])) {
            $test = TestController::update();
            header("location: ./index.php");
            die;
        }
        if(isset($_POST["destroy"])) {
            $test = TestController::destroy();
            header("location: ./index.php");
            die;
        }    
        
    }

    $tests = TestController::index();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test</title>
</head>
<body>

    <!-- form to create new items and update items-->

<div class="form">
    <form action="" method="post">
        <input type="number" name="test1" value = "<?= $edit ? $test->test1 : "" ?>" placeholder="test1">
        <input type="text" name="test2" value = "<?= $edit ? $test->test2 : "" ?>" placeholder="test2" >
        <input type="number" name="test3" value = "<?= $edit ? $test->test3 : "" ?>" placeholder="test3">
        <input type="hidden" name="id" value = "<?= $edit ? $test->id : "" ?>"> 
<?php
    if ($edit){?>
        <input type = "submit" name = "update" value = "update" id="button">
        </form>
        </div>
<?php }else {?>
        <input type="submit" name="save" value="save" id="button">
        </form>
        </div>
<?php }?>

<!-- end -->

<!-- creating table to show results in web page + buttons to edit and delete-->
    <?php { ?>
        <div id="table">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>test1</th>
                    <th>test2</th>
                    <th>test3</th>
                </tr>
    <?php foreach ($tests as $test) { ?>
                <tr>
        <?php foreach ($test as $item) { ?>  
                    <td><?=$item?></td>
        <?php } ?>
                <td>
                <form action = "" method = "post">
                <input type = "hidden" name = "id" value = "<?=$test->id?>">
                <input type = "submit" name = "edit" class = "" value = "EDIT">
                </form> 
                </td>
                <td>
                <form action = "" method = "post">
                <input type = "hidden" name = "id" value = "<?=$test->id?>">
                <input type = "submit" name = "destroy" class = "" value = "DELETE">
                </form> 
                </td>
    <?php } ?>  
                
    <?php }?>
<!-- ends -->
</body>
</html>