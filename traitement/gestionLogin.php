<?php
if (isset($_POST['mdp'])){
    $bdd = new PDO();

    $req = $bdd -> prepare('SELECT * FROM utilisateur WHERE email = :email AND mdp = :mdp');
    $req -> execute(array(
        'email' => $_POST['email'],
        'mdp' => $_POST['mdp']
    ));
    $donnee = $req -> fetch();
    session_start();
    $_SESSION['nom'] = $donnee['nom'];
    $_SESSION['id_user'] = $donnee['id_user'];
    if ($donnee){
        header("location:../index.php");
    }
    else{
        session_destroy();
        header("location:../login.php?erreur= Erreur, email ou mot de passe incorrect");
    }
}
