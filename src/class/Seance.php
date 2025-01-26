<?php
class Seance
{
    private $id_seance;
    private $date_seance;
    private $heure;
    private $ref_salle;
    private $ref_film;
    private $prix;
    public function __construct($array) {
        $this->hydrate($array);
    }

    public function hydrate(array $array) {
        foreach ($array as $key => $value) {
            // On récupère le nom du setter correspondant à l'attribut
            $method = 'set'.ucfirst($key);

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
    public function getId_seance()
    {
        return $this->id_seance;
    }

    /**
     * @param mixed $id_seance
     */
    public function setId_seance($id_seance)
    {
        $this->id_seance = $id_seance;
    }

    /**
     * @return mixed
     */
    public function getDate_seance()
    {
        return $this->date_seance;
    }

    /**
     * @param mixed $date_seance
     */
    public function setDate_seance($date_seance)
    {
        $this->date_seance = $date_seance;
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
    public function getRef_salle()
    {
        return $this->ref_salle;
    }

    /**
     * @param mixed $ref_salle
     */
    public function setRef_salle($ref_salle)
    {
        $this->ref_salle = $ref_salle;
    }

    /**
     * @return mixed
     */
    public function getRef_film()
    {
        return $this->ref_film;
    }

    /**
     * @param mixed $ref_film
     */
    public function setRef_film($ref_film)
    {
        $this->ref_film = $ref_film;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }
    
}