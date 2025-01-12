<?php
if(!isset($_POST)){
    header('location: index.php');
}
$bdd = include "../includes/bdd.php";

if(isset($_POST['modifierAdmin'])){
    $reqModif = $bdd->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, role = :role WHERE id_user = :id");
    $reqModif->execute(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'role' => $_POST['role'],
        'id' => $_POST['idmodif']
    ));
    $reqModif->closeCursor();
    header('location: ../admin.php?confirmModifUser=true#utilisateur');
}

if(isset($_POST['modifier'])){
    $reqModif = $bdd->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email WHERE id_user = :id");
    $reqModif->execute(array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'id' => $_POST['idmodif']
    ));
    $reqModif->closeCursor();
    header('location: ../profil.php?confirmModifUser=true#utilisateur');
}

if(isset($_POST['supprimerAdmin'])){
    $reqSupp = $bdd->prepare("DELETE FROM utilisateur WHERE id_user = :id");
    $reqSupp->execute(array(
        'id' => $_POST['idsup']
    ));
    $reqSupp->closeCursor();
    header('location: ../admin.php?confirmSupUser=true#utilisateur');
}
