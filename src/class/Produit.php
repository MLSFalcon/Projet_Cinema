<?php

class Produit
{
private $id_produit;
private $nom;
private $quantite;
private $type;
private $prixProduit;
    /**
     * @param $id_produit
     * @param $quantite
     * @param $type
     */
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
    public function getId_produit()
    {
        return $this->id_produit;
    }

    /**
     * @param mixed $id_produit
     */
    public function setId_produit($id_produit)
    {
        $this->id_produit = $id_produit;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param mixed $quantite
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getPrixProduit()
    {
        return $this->prixProduit;
    }

    /**
     * @param mixed $prixProduit
     */
    public function setPrixProduit($prixProduit)
    {
        $this->prixProduit = $prixProduit;
    }
}