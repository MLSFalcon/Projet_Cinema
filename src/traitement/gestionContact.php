<?php
require_once "../class/Contact.php";
require_once "../repository/ContactRepository.php";
require_once "../bdd/Bdd.php";
var_dump($_POST);
$action = new ContactRepository();
if (isset($_POST['sujet'])){
    $action->nouveauContact($contact = new Contact($_POST));
    header("location: ../../vue/contact.php?succes=Votre message a bien été envoyer");
}
if (isset($_POST['supprimer'])){
    $action->suppContact($contact = new Contact($_POST));
    header("location: ../../vue/admin.php");
}
