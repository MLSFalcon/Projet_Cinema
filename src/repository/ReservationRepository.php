<?php

class ReservationRepository
{
    private $bdd;

public function __construct(){
    $this->bdd = new Bdd();
}

public function ajouter($reservation)
{
    $req = $this->bdd->getBdd()->prepare('INSERT INTO seance(nb_place, ref_user, ref_seance) VALUES(:nb_place, :ref_user, :ref_seance)');
    $req->execute(array(
        'nb_place' => $reservation->getNbPlace(),
        'ref_user' => $reservation->getRefUser(),
        'ref_seance' => $reservation->getRefSeance()
    ));
    $req->closeCursor();
    return true;
}

public function update($reservation)
{
    $req = $this->bdd->getBdd()->prepare('UPDATE seance SET nb_place = :nb_place, ref_user = :ref_user, ref_seance = :ref_seance WHERE id_reservation = :id_reservation');
    $req->execute(array(
        'nb_place' => $reservation->getNbPlace(),
        'ref_user' => $reservation->getRefUser(),
        'ref_seance' => $reservation->getRefSeance(),
        'id_reservation' => $reservation->getIdReservation()
    ));
    $req->closeCursor();
    return true;
}

public function delete($reservation)
{
    $req = $this->bdd->getBdd()->prepare('DELETE FROM reservation WHERE id_reservation = :id_reservation');
    $req->execute(array(
        'id_reservation' => $reservation->getIdReservation()
    ));
    $req->closeCursor();
    return true;
}

public function listeReservations(){
    $requete = $this->bdd->getBdd()->prepare("SELECT * FROM `reservation`");
    $requete->execute();
    $listeReservations = $requete->fetchAll();
    $requete->closeCursor();
    return $listeReservations;
}

}