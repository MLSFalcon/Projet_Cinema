<?php

class SalleRepository
{
    public function ajouter($salle){
        $bdd = new Bdd() ;
        $req = $bdd ->getBdd()->prepare("INSERT INTO salle(nb_place) VALUES(:nbPlace)");
        $req -> execute(array('nbPlace' => $salle->getNbPlace()));
    }
    public function modifier($salle){
        $bdd = new Bdd() ;
        $req = $bdd -> getBdd() -> prepare("UPDATE salle set nb_place =:nb_place where idSalle = :idSalle");
        $req -> execute(array(
            'id salle' => $salle->getIdSalle(),
            'nbPlace' => $salle->getNbPlace() ));
    }
    public function supprimer($salle){
        $bdd = new Bdd() ;
        $req = $bdd -> getBdd() -> prepare("DELETE FROM salle where idSalle = :idSalle");
        $req -> execute(array('idSalle' => $salle->getIdSalle()));
    }

    public function listeSalle(){
        $bdd = new Bdd() ;
        $req = $bdd->getBdd()->prepare("SELECT * FROM salle");
        $req->execute();
        $listeSalle = $req->fetchAll();
        $req->closeCursor();
        return $listeSalle;
    }
    public function nombreSalle()
    {
        $bddUser = new Bdd();
        $req = $bddUser->getBdd()-> prepare('SELECT COUNT(id_salle) FROM salle');
        $req->execute();
        $donnee = $req->fetchAll();
        return $donnee[0];
    }
}
