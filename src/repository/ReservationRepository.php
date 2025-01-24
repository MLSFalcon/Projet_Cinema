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
}

}