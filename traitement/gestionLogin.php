<?php
$bdd = include '../includes/bdd.php';
if (isset($_POST['mdp'])){

    $req = $bdd -> prepare('SELECT * FROM utilisateur WHERE email = :email');
    $req -> execute(array(
        'email' => $_POST['email'],
    ));
    $donnee = $req -> fetch();
    var_dump($donnee['mdp']);
    var_dump(password_verify($_POST['mdp'], $donnee['mdp']));
    if ($donnee && password_verify($_POST['mdp'], $donnee['mdp'])) {
        session_start();
        $_SESSION['nom'] = $donnee['nom'];
        $_SESSION['id_user'] = $donnee['id_user'];
        $_SESSION['role'] = $donnee['role'];
        header("location:../index.php");
    }
    else{
        header("location:../login.php?erreur=Email ou mot de passe incorrect");
    }
}else{
    header('location: ../index.php');
}


