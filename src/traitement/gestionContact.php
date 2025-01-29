<?php
require_once "../class/Contact.php";
require_once "../repository/ContactRepository.php";
require_once "../bdd/Bdd.php";
var_dump($_POST);
$action = new ContactRepository();
if (isset($_POST)){
    $action->nouveauContact($contact = new Contact($_POST));
    header("location: ../../contact.php?succes=Votre message a bien été envoyer");
}
