<?php

class ContactRepository
{
    public function nouveauContact($contact)
    {
        $bddUser = new Bdd();

        $req = $bddUser->getBdd()->prepare('INSERT INTO contact(sujet, explication, ref_user) VALUES(:sujet, :explication, :ref_user)');
        $req->execute(array(
            'sujet' => $contact->getSujet(),
            'explication' => $contact->getExplication(),
            'ref_user' => $contact->getRefUser()
        ));
        $req->closeCursor();
        return true;
    }

    public function updateContact($contact)
    {
        $bddUser = new Bdd();
        $reqModif = $bddUser->getBdd()->prepare("UPDATE contact SET sujet = :sujet, explication= :explication, ref_user=:ref_user WHERE id_contact = :id");
        $reqModif->execute(array(
            'sujet' => $contact->getSujet(),
            'explication' => $contact->getExplication(),
            'ref_user' => $contact->getRefUser(),
        ));
        $reqModif->closeCursor();
    }

    public function suppContact($contact)
    {
        $bddUser = new Bdd();
        $reqSupp = $bddUser->getBdd()->prepare("DELETE FROM contact WHERE id_contact = :id");
        $reqSupp->execute(array(
            'id' => $contact->getIdContact()
        ));
        $reqSupp->closeCursor();
    }

    public function listeContacts(){
        $bddUser = new Bdd();
        $reqList = $bddUser->getBdd()->query("SELECT * FROM contact");
        $listeContacts = $reqList->fetchAll();
        
        return $listeContacts;
    }
}