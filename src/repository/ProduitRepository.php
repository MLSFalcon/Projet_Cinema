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
        $reqModif = $bdd->getBdd()->prepare("UPDATE produit SET nom = :nom, quantite = :quantite, type = :type, prixProduit = :prix WHERE id_produit = :id");
        $reqModif->execute(array(
            "nom" => $produit->getNom(),
            "quantite" => $produit->getQuantite(),
            "type" => $produit->getType(),
            "prix" => $produit->getPrixProduit(),
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
        $reqModif = $bdd->getBdd()->prepare("INSERT INTO produit (nom, quantite,type,prixProduit) VALUES (:nom, :quantite, :type, :prix)");
        $reqModif->execute(array(
            "nom" => $produit->getNom(),
            "quantite" => $produit->getQuantite(),
            "type" => $produit->getType(),
            "prix" => $produit->getPrixProduit(),
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

    public function update($produit)
    {
        $bdd = new Bdd();
        $requete = $bdd->getBdd()->prepare("UPDATE produit SET quantite=quantite-:quantite WHERE id_produit = :id_produit");
        $requete->execute(array(
           "id_produit" => $produit->getId_produit(),
           "quantite" => $produit->getQuantite()
        ));
    }
}