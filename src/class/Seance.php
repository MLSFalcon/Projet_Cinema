<?php
class Seance
{
    private $idSeance;
    private $dateSeance;
    private $heure;
    private $refSalle;
    private $refFilm;
    private $nbPlaceDispo;
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
    public function getIdSeance()
    {
        return $this->idSeance;
    }

    /**
     * @param mixed $idSeance
     */
    public function setIdSeance($idSeance)
    {
        $this->idSeance = $idSeance;
    }

    /**
     * @return mixed
     */
    public function getDateSeance()
    {
        return $this->dateSeance;
    }

    /**
     * @param mixed $dateSeance
     */
    public function setDateSeance($dateSeance)
    {
        $this->dateSeance = $dateSeance;
    }

    /**
     * @return mixed
     */
    public function getHeure()
    {
        return $this->heure;
    }

    /**
     * @param mixed $heure
     */
    public function setHeure($heure)
    {
        $this->heure = $heure;
    }

    /**
     * @return mixed
     */
    public function getRefSalle()
    {
        return $this->refSalle;
    }

    /**
     * @param mixed $refSalle
     */
    public function setRefSalle($refSalle)
    {
        $this->refSalle = $refSalle;
    }

    /**
     * @return mixed
     */
    public function getRefFilm()
    {
        return $this->refFilm;
    }

    /**
     * @param mixed $refFilm
     */
    public function setRefFilm($refFilm)
    {
        $this->refFilm = $refFilm;
    }

    /**
     * @return mixed
     */
    public function getNbPlaceDispo()
    {
        return $this->nbPlaceDispo;
    }

    /**
     * @param mixed $nbPlaceDispo
     */
    public function setNbPlaceDispo($nbPlaceDispo)
    {
        $this->nbPlaceDispo = $nbPlaceDispo;
    }
    
}