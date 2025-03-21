<?php
class Bdd
{

    private $bdd;

    function __construct()
    {
        $this->bdd = new PDO('mysql:host=127.0.0.1;dbname=mnrt_cinema;charset=utf8', 'root', 'toor');
    }

    function getBdd()
    {
        return $this->bdd;
    }
}