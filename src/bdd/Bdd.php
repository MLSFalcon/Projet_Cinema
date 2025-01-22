<?php
class Bdd
{

    private $bdd;

    function __construct()
    {
        $this->bdd = new PDO('mysql:host=hoziodev.fr;dbname=mnrt_cinema;charset=utf8', 'bdd_cinema', 'jozdZSM#9');
    }

    function getBdd()
    {
        return $this->bdd;
    }
}