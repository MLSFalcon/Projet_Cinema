<?php
var_dump($_POST);
$action = new FilmRepository();
if (isset($_POST['ajoutFilm'])){
    $action->ajouter($film = new Film($_POST));
}
if (isset($_POST['supprimerFilm'])){
    $action->supprimer($film = new Film($_POST));
}
if (isset($_POST['modifierFilm'])){
    $action->modifier($film = new Film($_POST));
}
