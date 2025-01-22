
<?php

class Reservation
{
    private $idReservation;
    private $nbPlace;
    private $refUser;
    private $refSeance;

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
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * @param mixed $idReservation
     */
    public function setIdReservation($idReservation)
    {
        $this->idReservation = $idReservation;
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

    /**
     * @return mixed
     */
    public function getRefUser()
    {
        return $this->refUser;
    }

    /**
     * @param mixed $refUser
     */
    public function setRefUser($refUser)
    {
        $this->refUser = $refUser;
    }

    /**
     * @return mixed
     */
    public function getRefSeance()
    {
        return $this->refSeance;
    }

    /**
     * @param mixed $refSeance
     */
    public function setRefSeance($refSeance)
    {
        $this->refSeance = $refSeance;
    }
}