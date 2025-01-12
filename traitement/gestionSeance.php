<?php

$bdd = include '../includes/bdd.php';
if (isset($_POST['idmodif'])) {
    $req = $bdd -> prepare('UPDATE seance SET date_seance = :date_seance, heure = :heure, ref_salle = :ref_salle, ref_film = :ref_film, nb_place_dispo = :place WHERE id_seance = :id_seance');
    $req -> execute(array(
        'date_seance' => $_POST['date'],
        'heure' => $_POST['heure'],
        'ref_salle' => $_POST['salle'],
        'ref_film' => $_POST['titre'],
        'place' => $_POST['nbPlace'],
        'id_seance' => $_POST['idmodif']
    ));
    $req->closeCursor();
    header('Location: ../admin.php');
}
if (isset($_POST['supprimerAdmin'])) {
    var_dump($_POST);
    $req = $bdd -> prepare('DELETE FROM seance WHERE id_seance = :id_seance');
    $req -> execute(array(
        'id_seance' => $_POST['idsup']
    ));
    $req->closeCursor();
    header('Location: ../admin.php');
}
if (isset($_POST['ajoutSeance'])) {
    var_dump($_POST);
    $req = $bdd -> prepare('INSERT INTO `seance`(`date_seance`, `heure`, `ref_salle`, `ref_film`, `nb_place_dispo`) VALUES (:date,:heure,:ref_salle,:ref_film,:place)');
    $req -> execute(array(
        'date' => $_POST['date'],
        'heure' => $_POST['heure'],
        'ref_salle' => $_POST['salle'],
        'ref_film' => $_POST['titre'],
        'place' => $_POST['place']
    ));
    $req->closeCursor();
    header('Location: ../admin.php');
}