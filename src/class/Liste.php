<?php
require_once "../bdd/Bdd.php";
class Liste
{
    private $bdd;
    public function __construct()
    {
        $this->bdd = new Bdd();
    }

public function listeFilms(){
    $requete = $this->bdd->getBdd()->prepare("SELECT * FROM `film`");
    $requete->execute();
    $listeFilms = $requete->fetchAll();
    $requete->closeCursor();
    return $listeFilms;
}
public function listeUtilisateurs(){
    $requete = $this->bdd->getBdd()->prepare("SELECT id_user,nom, prenom, email, role FROM `utilisateur`");
    $requete->execute();
    $listeUsers = $requete->fetchAll();
    $requete->closeCursor();
    return $listeUsers;
}
public function listeSeances(){
    $requete = $this->bdd->getBdd()->prepare("SELECT film.titre, seance.id_seance, seance.date_seance, seance.heure, seance.nb_place_dispo, seance.ref_salle as salle  FROM `film` INNER JOIN `seance` ON film.id_film = seance.ref_film");
    $requete->execute();
    $listeSeances = $requete->fetchAll();
    $requete->closeCursor();
    return $listeSeances;
}
public function listeSeance(){
    $requete = $this->bdd->getBdd()->prepare("SELECT * FROM `seance`");
    $requete->execute();
    $listeSeance = $requete->fetchAll();
    $requete->closeCursor();
    return $listeSeance;
}
public function listeReservations(){
    $requete = $this->bdd->getBdd()->prepare("SELECT utilisateur.email, reservation.nb_place, seance.date_seance, seance.heure, seance.ref_salle, film.titre FROM `utilisateur` INNER JOIN reservation ON utilisateur.id_user = reservation.ref_user INNER JOIN seance ON reservation.ref_seance = seance.id_seance INNER JOIN film ON seance.ref_film = film.id_film");
    $requete->execute();
    $listeReservations = $requete->fetchAll();
    $requete->closeCursor();
    return $listeReservations;
}
public function listeSalle(){
    $requete = $this->bdd->getBdd()->prepare("SELECT * FROM `salle`");
    $requete->execute();
    $listeSalle = $requete->fetchAll();
    $requete->closeCursor();
    return $listeSalle;
}
}