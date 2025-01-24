<?php

class SeanceRepository
{   public function nouvelleSeance($seance){
    $bddUser = new Bdd();

    $req = $bddUser->getBdd()->prepare('INSERT INTO date_seance(date_seance, heure, ref_salle, ref_film, prix) VALUES(:date_seance, :heure, :ref_salle, :ref_film, :prix)');
    $req->execute(array(
        'date_seance' => $seance->getDateSeance(),
        'heure' => $seance->getHeure(),
        'ref_salle' => $seance->getRefSalle(),
        'ref_film' => $seance->getRefFilm(),
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
            'date_seance' => $seance->getDateSeance(),
            'heure' => $seance->getHeure(),
            'ref_salle' => $seance->getRefSalle(),
            'ref_film' => $seance->getRefFilm(),
            'prix' => $seance->getPrix()
        ));
        $reqModif->closeCursor();
    }

    public function suppSeance($seance)
    {
        $bddUser = new Bdd();
        $reqSupp = $bddUser->getBdd()->prepare("DELETE FROM seance WHERE id_seance = :id");
        $reqSupp->execute(array(
            'id' => $seance->getIdSeance()
        ));
        $reqSupp->closeCursor();
    }

    public function listeSeances(){
    $bddUser = new Bdd();
    $req = $bddUser->getBdd()->query("SELECT film.titre, seance.id_seance, seance.date_seance, seance.heure, seance.prix, seance.ref_salle as salle  FROM `film` INNER JOIN `seance` ON film.id_film = seance.ref_film");
    $req->execute();
    $listeSeances = $req->fetchAll();

    return $listeSeances;
    }

}