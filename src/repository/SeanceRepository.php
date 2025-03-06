<?php

class SeanceRepository
{   public function nouvelleSeance($seance){
    $bddUser = new Bdd();

    $req = $bddUser->getBdd()->prepare('INSERT INTO seance(date_seance, heure, ref_salle, ref_film, prix) VALUES(:date_seance, :heure, :ref_salle, :ref_film, :prix)');
    $req->execute(array(
        'date_seance' => $seance->getDate_seance(),
        'heure' => $seance->getHeure(),
        'ref_salle' => $seance->getRef_salle(),
        'ref_film' => $seance->getRef_film(),
        'prix' => $seance->getPrix()
    ));
    $req->closeCursor();
    return true;
}

    public function updateSeance($seance)
    {
        $bddUser = new Bdd();
        $reqModif = $bddUser->getBdd()->prepare("UPDATE seance SET date_seance = :date_seance, heure = :heure, ref_salle=:ref_salle, ref_film=:ref_film, prix=:prix WHERE id_seance = :id");
        $reqModif->execute(array(
            'date_seance' => $seance->getDate_seance(),
            'heure' => $seance->getHeure(),
            'ref_salle' => $seance->getRef_salle(),
            'ref_film' => $seance->getRef_film(),
            'prix' => $seance->getPrix(),
            'id' => $seance->getId_seance(),
        ));
        $reqModif->closeCursor();
    }

    public function suppSeance($seance)
    {
        $bddUser = new Bdd();
        $reqSupp = $bddUser->getBdd()->prepare("DELETE FROM seance WHERE id_seance = :id");
        $reqSupp->execute(array(
            'id' => $seance->getId_seance()
        ));
        $reqSupp->closeCursor();
    }

    public function listeSeances(){
    $bddUser = new Bdd();
    $req = $bddUser->getBdd()->prepare("SELECT film.titre, seance.id_seance, seance.date_seance, seance.heure, seance.prix, seance.ref_salle as salle  FROM `film` INNER JOIN `seance` ON film.id_film = seance.ref_film");
    $req->execute();
    $listeSeances = $req->fetchAll();

    return $listeSeances;
    }

    public function listeSeancesFilm($id)
    {
        $bddUser = new Bdd();
        $req = $bddUser->getBdd()->prepare("SELECT *,sa.nb_place as nb_place_salle,sa.nb_place-SUM(r.nb_place) as nb_place_disp FROM seance s INNER JOIN film f ON f.id_film=s.ref_film INNER JOIN salle sa ON s.ref_salle=sa.id_salle LEFT JOIN reservation as r ON r.ref_seance=s.id_seance WHERE f.id_film = :id GROUP BY s.id_seance;");
        //$req = $bddUser->getBdd()->prepare("SELECT * FROM seance WHERE ref_film = :id");
        $req->execute(array("id" => $id));
        $listeSeances = $req->fetchAll();

        return $listeSeances;
    }
    public function nombreSeance()
    {
        $bddUser = new Bdd();
        $req = $bddUser->getBdd()-> prepare('SELECT COUNT(id_seance) FROM seance');
        $req->execute();
        $donnee = $req->fetchAll();
        return $donnee[0];
    }
}