<?php
session_start();
if(!isset($_SESSION['id_user'])){
    header('location: index.php');
}
session_destroy();
header("location:../index.php");
