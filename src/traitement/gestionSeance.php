<?php
var_dump($_POST);
require_once "../bdd/Bdd.php";
require_once "../repository/SeanceRepository.php";
require_once "../class/Seance.php";

$action = new Seance()
