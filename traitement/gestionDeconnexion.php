<?php
if(!isset($_SESSION)){
    header('location: index.php');
}
session_start();
session_destroy();
header("location:../index.php");
