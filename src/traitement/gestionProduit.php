<?php
var_dump($_POST);
require_once "../bdd/Bdd.php";
require_once "../repository/ProduitRepository.php";
require_once "../class/Produit.php";

$action = new ProduitRepository();
if (isset($_POST['ajoutProduit'])){
    $action->ajouter($produit = new Produit($_POST));
    header("location: ../../vue/admin.php");
}
if (isset($_POST['supprimerProduit'])){
    $action->supprimer($produit = new Produit($_POST));
    header("location: ../../vue/admin.php");
}
if (isset($_POST['modifierProduit'])){
    $action->modifier($produit = new Produit($_POST));
    header("location: ../../vue/admin.php");
}