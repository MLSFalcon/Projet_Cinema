<?php
if(!isset($_POST)){
    header('location: index.php');
}
require_once "../includes/bdd.php";
$bdd = new BDD();


if(isset($_POST['ajoutFilm'])){
    $reqModif = $bdd->getBdd()->prepare("INSERT INTO film (titre, resume, genre, duree, image) VALUES (:titre, :resume, :genre, :duree, :image)");
    $reqModif->execute(array(
        "image" => $_POST['image'],
        "titre" => $_POST['titre'],
        "resume" => $_POST['resume'],
        "genre" => $_POST['genre'],
        "duree" => $_POST['duree'],
    ));
    $reqModif->closeCursor();
    header('location: ../admin.php');
    var_dump($_POST);
}

if(isset($_POST['modifierFilm'])){
    $reqModif = $bdd->getBdd()->prepare("UPDATE film SET image = :image, titre = :titre, resume = :resume, genre = :genre, duree = :duree WHERE id_film = :id");
    $reqModif->execute(array(
        "image" => $_POST['image'],
        "titre" => $_POST['titre'],
        "resume" => $_POST['resume'],
        "genre" => $_POST['genre'],
        "duree" => $_POST['duree'],
        "id" => $_POST['idmodif']
    ));
    $reqModif->closeCursor();
    header('location: ../admin.php');
    var_dump($_POST);
}

if(isset($_POST['supprimerFilm'])){
    $reqSupp = $bdd->getBdd()->prepare("DELETE FROM film WHERE id_film = :id");
    $reqSupp->execute(array(
        'id' => $_POST['idsup']
    ));
    $reqSupp->closeCursor();
    header('location: ../admin.php');
}
