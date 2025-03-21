<?php

class ReservationRepository
{
    private $bdd;

public function __construct(){
    $this->bdd = new Bdd();
}

public function ajouter($reservation)
{

    $req = $this->bdd->getBdd()->prepare('INSERT INTO reservation(nb_place, ref_user, ref_seance, nbr_repere) VALUES(:nb_place, :ref_user, :ref_seance, :nbr_repere)');
    $req->execute(array(
        'nb_place' => $reservation->getNb_place(),
        'ref_user' => $reservation->getRef_user(),
        'ref_seance' => $reservation->getRef_seance(),
        'nbr_repere' => $reservation->getNbr_repere()
    ));
    $req->closeCursor();
    return true;
}

public function update($reservation)
{
    $req = $this->bdd->getBdd()->prepare('UPDATE reservation SET nb_place = :nb_place, ref_user = :ref_user, ref_seance = :ref_seance WHERE id_reservation = :id_reservation');
    $req->execute(array(
        'nb_place' => $reservation->getNb_place(),
        'ref_user' => $reservation->getRef_user(),
        'ref_seance' => $reservation->getRef_seance(),
        'id_reservation' => $reservation->getId_reservation()
    ));
    $req->closeCursor();
    return true;
}

public function delete($reservation)
{
    $req = $this->bdd->getBdd()->prepare('DELETE FROM reservation WHERE id_reservation = :id_reservation');
    $req->execute(array(
        'id_reservation' => $reservation->getId_reservation()
    ));
    $req->closeCursor();
    return true;
}

public function listeReservations(){
    $requete = $this->bdd->getBdd()->prepare("SELECT utilisateur.email, reservation.ref_user, reservation.nb_place, seance.date_seance, seance.heure, seance.ref_salle, film.titre, reservation.id_reservation FROM `utilisateur` INNER JOIN reservation ON utilisateur.id_user = reservation.ref_user INNER JOIN seance ON reservation.ref_seance = seance.id_seance INNER JOIN film ON seance.ref_film = film.id_film");
    $requete->execute();
    $listeReservations = $requete->fetchAll();
    $requete->closeCursor();
    return $listeReservations;
}

public function suppNbrRepere($reservation){
    $bdd = new Bdd();
    $req = $bdd->getBdd()->prepare("UPDATE reservation SET nbr_repere = :nbr_repere WHERE id_reservation = :id_reservation");
    $req->execute(array(
        'nbr_repere' => null,
        'id_reservation' => $reservation[0]));
    $req->closeCursor();
    return true;
}

public function recupReservation($reservation){
    $bdd = new Bdd();
    $req = $bdd->getBdd()->prepare("SELECT * FROM `reservation` WHERE nbr_repere = :nbr_repere");
    $req->execute(array(
        'nbr_repere' => $reservation->getNbr_repere()
    ));
    $reservation = $req->fetch();
    return $reservation;
}

    public function listeReservationsUser($id_user){
        $requete = $this->bdd->getBdd()->prepare("SELECT utilisateur.email, reservation.ref_user, reservation.nb_place, seance.date_seance, seance.heure, seance.ref_salle, film.titre, reservation.id_reservation FROM `utilisateur` INNER JOIN reservation ON utilisateur.id_user = reservation.ref_user INNER JOIN seance ON reservation.ref_seance = seance.id_seance INNER JOIN film ON seance.ref_film = film.id_film WHERE utilisateur.id_user = :id_user");
        $requete->execute(array('id_user' => $id_user));
        $listeReservations = $requete->fetchAll();
        $requete->closeCursor();
        return $listeReservations;
    }
    public function nombreResa()
    {
        $bddUser = new Bdd();
        $req = $bddUser->getBdd()-> prepare('SELECT COUNT(id_reservation) FROM reservation');
        $req->execute();
        $donnee = $req->fetchAll();
        return $donnee[0];
    }
}



