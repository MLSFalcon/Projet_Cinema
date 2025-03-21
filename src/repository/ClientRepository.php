<?php

class ClientRepository
{
    public function modifierAdresse(Client $client){
        $sql = "UPDATE utilisateur 
                SET adresseFacturation = :adresse 
                WHERE id_user = :id";
        $bddUser = new Bdd();
        $reqModif = $bddUser->getBdd()->prepare($sql);
        $reqModif->execute(array(
            'adresse' => $client->getAdresseFacturation(),
            'id' => $client->getId_User()
        ));
        $reqModif->closeCursor();
    }
}