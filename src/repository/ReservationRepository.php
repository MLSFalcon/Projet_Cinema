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
    $requete = $this->bdd->getBdd()->prepare("SELECT utilisateur.email, reservation.nb_place, seance.date_seance, seance.heure, seance.ref_salle, film.titre, reservation.id_reservation FROM `utilisateur` INNER JOIN reservation ON utilisateur.id_user = reservation.ref_user INNER JOIN seance ON reservation.ref_seance = seance.id_seance INNER JOIN film ON seance.ref_film = film.id_film");
    $requete->execute();
    $listeReservations = $requete->fetchAll();
    $requete->closeCursor();
    return $listeReservations;
}

}