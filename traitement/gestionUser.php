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

if (isset($_POST['ajoutUser'])) {
    $mdpchiffre = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
    $req = $bdd->prepare('SELECT * FROM utilisateur WHERE email = :email');
    $req->execute(array(
        'email' => $_POST['email']
    ));
    $liste = $req->fetchAll();
    if ($liste){
        header("location:../admin.php?erreur=Le compte existe déjà");
    } else{
        var_dump($liste);
        $req = $bdd->prepare('INSERT INTO utilisateur(nom, prenom, email, mdp, role) VALUES(:nom, :prenom, :email, :mdp, :role)');
        $req->execute(array(
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'mdp' => $mdpchiffre,
            'role' => $_POST['role']
        ));
        $req->closeCursor();
        echo $mdpchiffre;
        header("location:../admin.php?confirm=Inscription bien prise en compte !");
    }
}