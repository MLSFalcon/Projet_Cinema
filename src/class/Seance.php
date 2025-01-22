<?php
require_once "../bdd/Bdd.php";
class Seance
{
    private $bdd;
    public function __construct()
    {
        $this->bdd = new Bdd();
    }
    public function modifier($date,$heure,$salle,$titre,$nbPlace,$idmodif){
        $req = $this->bdd->getBdd() -> prepare('UPDATE seance SET date_seance = :date_seance, heure = :heure, ref_salle = :ref_salle, ref_film = :ref_film, nb_place_dispo = :place WHERE id_seance = :id_seance');
        $req -> execute(array(
            'date_seance' => $date,
            'heure' => $heure,
            'ref_salle' => $salle,
            'ref_film' => $titre,
            'place' => $nbPlace,
            'id_seance' => $idmodif
        ));
        $req->closeCursor();
    }
    public function ajouter($date,$heure,$salle,$titre,$place){
        $req = $this->bdd->getBdd() -> prepare('INSERT INTO `seance`(`date_seance`, `heure`, `ref_salle`, `ref_film`, `nb_place_dispo`) VALUES (:date,:heure,:ref_salle,:ref_film,:place)');
        $req -> execute(array(
            'date' => $date,
            'heure' => $heure,
            'ref_salle' => $salle,
            'ref_film' => $titre,
            'place' => $place
        ));
        $req->closeCursor();
    }
    public function supprimer($id){
        $req = $this->bdd->getBdd() -> prepare('DELETE FROM seance WHERE id_seance = :id_seance');
        $req -> execute(array(
            'id_seance' => $id
        ));
        $req->closeCursor();
    }

}