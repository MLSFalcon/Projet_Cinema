<?php
require_once '../class/Reservation.php';
require_once '../repository/ReservationRepository.php';
require_once '../bdd/bdd.php';

if(isset($_POST['ajout'])){
    $donnees = (array(
        "nb_place" => $_POST['nb_place'],
        "ref_user" => $_POST['ref_user'],
        "ref_seance" => $_POST['ref_seance'],
        "ref_produit" => $_POST['ref_produit'],
    ));
    $reservation = new Reservation($donnees);
    var_dump($reservation);
    $creationReservation = new ReservationRepository();
    if ($creationReservation->ajouter($reservation)){
        header('Location: ../../vue/index.php?reserver=ok');
    }else{
        header('Location: ../../vue/index.php?reserver=error');
    }
}


var_dump($_POST);
if (isset($_POST['annuler'])){
    $donnee = array(
    'id_reservation' => $_POST['reservation'],
    );

$reservation = new Reservation($donnee);
$supprimer = new ReservationRepository();
$supprimer->delete($reservation);
header('Location:../../vue/profil.php');
}