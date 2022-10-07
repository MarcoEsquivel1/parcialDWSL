<?php  

session_start();

//unset($_SESSION['session']);
session_destroy();

header('location:../index.php');
?>