<?php

class Salle
{

    private $idSalle;
    private $nbPlace;

    public function __construct($array) {
        $this->hydrate($array);
    }

    public function hydrate(array $array) {
        foreach ($array as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut
            $method = 'set'.ucfirst($key);
            var_dump($method);

            // Si le setter correspondant existe.
            if (method_exists($this, $method)) {
                // On appelle le setter
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getIdSalle()
    {
        return $this->idSalle;
    }

    /**
     * @param mixed $idSalle
     */
    public function setIdSalle($idSalle)
    {
        $this->idSalle = $idSalle;
    }

    /**
     * @return mixed
     */
    public function getNbPlace()
    {
        return $this->nbPlace;
    }

    /**
     * @param mixed $nbPlace
     */
    public function setNbPlace($nbPlace)
    {
        $this->nbPlace = $nbPlace;
    }

}