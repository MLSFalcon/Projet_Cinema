<?php
require_once '../class/Reservation.php';
require_once '../repository/ReservationRepository.php';
require_once '../class/ReservationProduit.php';
require_once '../repository/ReservationProduitRepository.php';
require_once '../class/Produit.php';
require_once '../repository/ProduitRepository.php';
require_once '../bdd/bdd.php';

if (isset($_POST['reserver'])){
    $nbrRepere = rand();
    $reservation = (array(
        "nb_place" => $_POST['nb_place'],
        "ref_user" => $_POST['ref_user'],
        "ref_seance" => $_POST['ref_seance'],
        "nbr_repere" => $nbrRepere,
    ));
    $reservation = new Reservation($reservation);
    $creationReservation = new ReservationRepository();
    if ($creationReservation->ajouter($reservation)){
        $reservation = $creationReservation->recupReservation($reservation);
        for ($i=0; $i < $_POST['i']; $i++){
            if (isset($_POST['ref_produit'.$i])){
                $donnees = (array(
                    "refProduit" => $_POST['ref_produit'.$i],
                    "quantiteProduit" => $_POST['quantite_produit'.$i],
                    "refReservation" => $reservation[0],
                ));
                $reservationProduit = new ReservationProduit($donnees);
                $creationReservationProduit = new ReservationProduitRepository();
                if (!$creationReservationProduit->ajouter($reservationProduit)) {
                    header('Location: ../../vue/index.php?reserver=errorProduit');
                }else{
                    $modifProduit = (array(
                        "id_produit" => $_POST['ref_produit'.$i],
                        "quantite" => $_POST['quantite_produit'.$i],
                    ));
                    $produit = new Produit($modifProduit);
                    $updateProduit = new ProduitRepository();
                    $updateProduit->update($produit);
                }
            }
        }
        $creationReservation->suppNbrRepere($reservation);
        header('Location: ../../vue/index.php?reserver=ok');
    }else {
        header('Location: ../../vue/index.php?reserver=errorReservation');
    }
}


if (isset($_POST['annuler'])){
    $donnee = array(
    'id_reservation' => $_POST['reservation'],
    );

$reservation = new Reservation($donnee);
$supprimer = new ReservationRepository();
$supprimer->delete($reservation);
header('Location:../../vue/profil.php');
}