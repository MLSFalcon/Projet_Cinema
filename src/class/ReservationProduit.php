<?php

class ReservationProduit
{
    private $id_reservationproduit;

    private $ref_produit;

    private $ref_reservation;

    private $quantite_produit;

    public function __construct($array)
    {
        $this->hydrate($array);
    }

    private function hydrate($array) {
        foreach ($array as $key => $value) {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getIdReservationproduit()
    {
        return $this->id_reservationproduit;
    }

    /**
     * @param mixed $id_reservationproduit
     */
    public function setIdReservationproduit($id_reservationproduit)
    {
        $this->id_reservationproduit = $id_reservationproduit;
    }

    /**
     * @return mixed
     */
    public function getRefProduit()
    {
        return $this->ref_produit;
    }

    /**
     * @param mixed $ref_produit
     */
    public function setRefProduit($ref_produit)
    {
        $this->ref_produit = $ref_produit;
    }

    /**
     * @return mixed
     */
    public function getRefReservation()
    {
        return $this->ref_reservation;
    }

    /**
     * @param mixed $ref_reservation
     */
    public function setRefReservation($ref_reservation)
    {
        $this->ref_reservation = $ref_reservation;
    }

    /**
     * @return mixed
     */
    public function getQuantiteProduit()
    {
        return $this->quantite_produit;
    }

    /**
     * @param mixed $quantite_produit
     */
    public function setQuantiteProduit($quantite_produit)
    {
        $this->quantite_produit = $quantite_produit;

    }
}