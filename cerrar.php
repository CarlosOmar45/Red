<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "/home/conectared.php";
$con = conecta();
if(empty($_SESSION['id'])){
    header('Location: ./login.php');
}
?>