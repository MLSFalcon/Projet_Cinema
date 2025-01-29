<?php
<<<<<<< HEAD
var_dump($_POST);
require_once "../bdd/Bdd.php";
require_once "../repository/SeanceRepository.php";
require_once "../class/Seance.php";

$action = new Seance()
=======

require_once '../bdd/Bdd.php';
require_once '../class/Seance.php';
require_once '../repository/SeanceRepository.php';

if (isset($_POST['ajoutSeance'])){
    $hydrate = array(
        'ref_film' => $_POST['ref_film'],
        'date_seance' => $_POST['date_seance'],
        'heure' => $_POST['heure'],
        'ref_salle' => $_POST['ref_salle'],
        'prix' => $_POST['prix'],
    );
    $seance = new Seance($hydrate);
    $action = new SeanceRepository();
    $action->nouvelleSeance($seance);
    header("location: ../../admin.php");
}
if (isset($_POST['modifierSeance'])){
    $hydrate = array(
        'ref_film' => $_POST['ref_film'],
        'date_seance' => $_POST['date_seance'],
        'heure' => $_POST['heure'],
        'ref_salle' => $_POST['ref_salle'],
        'prix' => $_POST['prix'],
        'id_seance' => $_POST['id_seance']
    );
    $seance = new Seance($hydrate);
    $action = new SeanceRepository();
    $action->updateSeance($seance);
    header("location: ../../admin.php");
}



if (isset($_POST['supprimerSeance'])){
    $hydrate = array('id_seance' => $_POST['id_seance']);
    $seance = new Seance($hydrate);
    $action = new SeanceRepository();
    $action->suppSeance($seance);
    header("location: ../../admin.php");
}
>>>>>>> 4889f5a79d2f5f25f3bc7b1d5b659730d82c6eb1
