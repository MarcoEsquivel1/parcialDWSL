<?php
    require_once("../controllers/usersController.php");
    $obj = new UsersController();
    $rows =  $obj->index();
    session_start();
    if(isset($_SESSION['session']) != true || $_SESSION['session'] != true){
        header('location:../index.php');
    }else{
        $obj->genPDF($rows);
    }
?>