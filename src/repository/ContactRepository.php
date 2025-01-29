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
            'ref_user' => $contact->getRef_user()
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
            'ref_user' => $contact->getRef_user(),
        ));
        $reqModif->closeCursor();
    }

    public function suppContact($contact)
    {
        $bddUser = new Bdd();
        $reqSupp = $bddUser->getBdd()->prepare("DELETE FROM contact WHERE id_contact = :id");
        $reqSupp->execute(array(
            'id' => $contact->getId_contact()
        ));
        $reqSupp->closeCursor();
    }

    public function listeContacts(){
        $bddUser = new Bdd();
        $reqList = $bddUser->getBdd()->query("SELECT c.*, u.email FROM contact as c INNER JOIN utilisateur as u ON u.id_user = c.ref_user");
        $listeContacts = $reqList->fetchAll();

        return $listeContacts;
    }
    public function countContact(){
        $bddUser = new Bdd();
        $reqList = $bddUser->getBdd()->query("SELECT count(id_contact) as nombre FROM contact");
        $nbContact = $reqList->fetch();

        return $nbContact;
    }
}