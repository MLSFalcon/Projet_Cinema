
<?php

class Reservation
{
    private $id_reservation;
    private $nb_place;
    private $ref_user;
    private $ref_seance;
    private $nbr_repere;

    /**
     * @return mixed
     */
    public function getNbr_repere()
    {
        return $this->nbr_repere;
    }

    /**
     * @param mixed $nbr_repere
     */
    public function setNbr_repere($nbr_repere)
    {
        $this->nbr_repere = $nbr_repere;
    }




    private function hydrate($array) {
        foreach ($array as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    public function __construct($array)
    {
        $this->hydrate($array);
    }

    /**
     * @return mixed
     */
    public function getId_reservation()
    {
        return $this->id_reservation;
    }

    /**
     * @param mixed $id_reservation
     */
    public function setId_reservation($id_reservation)
    {
        $this->id_reservation = $id_reservation;
    }

    /**
     * @return mixed
     */
    public function getNb_place()
    {
        return $this->nb_place;
    }

    /**
     * @param mixed $nb_place
     */
    public function setNb_place($nb_place)
    {
        $this->nb_place = $nb_place;
    }

    /**
     * @return mixed
     */
    public function getRef_user()
    {
        return $this->ref_user;
    }

    /**
     * @param mixed $ref_user
     */
    public function setRef_user($ref_user)
    {
        $this->ref_user = $ref_user;
    }

    /**
     * @return mixed
     */
    public function getRef_seance()
    {
        return $this->ref_seance;
    }

    /**
     * @param mixed $ref_seance
     */
    public function setRef_seance($ref_seance)
    {
        $this->ref_seance = $ref_seance;
    }
}