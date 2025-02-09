<?php

class ReservationProduitRepository
{
    public function ajouter($reservationProduit){
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare("INSERT INTO reservationproduit(ref_produit,ref_reservation,quantite_produit) VALUES(:ref_produit,:ref_reservation,:quantite_produit)");
        $req->execute(array(
            'ref_produit' => $reservationProduit->getRefProduit(),
            'ref_reservation' => $reservationProduit->getRefReservation(),
            'quantite_produit' => $reservationProduit->getQuantiteProduit()
        ));
        $req->closeCursor();
        return true;
    }

    public function listeReservationProduits(){
        $bdd = new Bdd();
        $requete = $bdd->getBdd()->prepare("SELECT * FROM `reservationproduit`");
        $requete->execute();
        $listeProduit = $requete->fetchAll();
        $requete->closeCursor();
        return $listeProduit;
    }

}