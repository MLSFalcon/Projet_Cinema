<?php
var_dump($_POST);
require_once "../bdd/Bdd.php";
require_once "../repository/FilmRepository.php";
require_once "../class/Film.php";
$action = new FilmRepository();
if (isset($_POST['ajoutFilm'])){
    $action->ajouter($film = new Film($_POST));
    header("location: ../");
}
if (isset($_POST['supprimerFilm'])){
    $action->supprimer($film = new Film($_POST));
}
if (isset($_POST['modifierFilm'])){
    $action->modifier($film = new Film($_POST));
}
