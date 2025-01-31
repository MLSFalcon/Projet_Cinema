<?php

class ProduitRepository
{
    /**
     * @param Produit $produit
     * @return void
     */
    public function modifier($produit)
    {
        $bdd = new Bdd();
        $reqModif = $bdd->getBdd()->prepare("UPDATE produit SET nom = :nom, quantite = :quantite, type = :type WHERE id_produit = :id");
        $reqModif->execute(array(
            "nom" => $produit->getNom(),
            "quantite" => $produit->getQuantite(),
            "type" => $produit->getType(),
            "id" => $produit->getId_produit(),

        ));
        $reqModif->closeCursor();
    }

    /**
     * @param Produit $produit
     * @return void
     */
    public function ajouter(Produit $produit)
    {
        $bdd = new Bdd();
        $reqModif = $bdd->getBdd()->prepare("INSERT INTO produit (nom, quantite,type) VALUES (:nom, :quantite, :type)");
        $reqModif->execute(array(
            "nom" => $produit->getNom(),
            "quantite" => $produit->getQuantite(),
            "type" => $produit->getType(),
        ));
        $reqModif->closeCursor();
    }

    /**
     * @param Produit $produit
     * @return void
     */
    public function supprimer($produit)
    {
        $bdd = new Bdd();
        $reqSupp = $bdd->getBdd()->prepare("DELETE FROM produit WHERE id_produit = :id");
        $reqSupp->execute(array(
            'id' => $produit->getId_produit()
        ));
        $reqSupp->closeCursor();
    }
    public function listeProduit(){
        $bdd = new Bdd();
        $requete = $bdd->getBdd()->prepare("SELECT * FROM `produit`");
        $requete->execute();
        $listeProduit = $requete->fetchAll();
        $requete->closeCursor();
        return $listeProduit;
    }
    public function count(){
        $bdd = new Bdd();
        $requete = $bdd->getBdd()->prepare("SELECT type,SUM(quantite) as nb FROM `produit` GROUP BY type;");
        $requete->execute();
        $count = $requete->fetchAll();
        $requete->closeCursor();
        return $count;
    }
}