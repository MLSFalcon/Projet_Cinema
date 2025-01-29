<?php
require_once '../class/Reservation.php';
require_once '../repository/ReservationRepository.php';
require_once '../bdd/bdd.php';


var_dump($_POST);
if (isset($_POST['annuler'])){
    $donnee = array(
    'id_reservation' => $_POST['reservation'],
    );

$reservation = new Reservation($donnee);
$supprimer = new ReservationRepository();
$supprimer->delete($reservation);
header('Location:../../profil.php');
}