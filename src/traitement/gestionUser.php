<?php
require_once '../bdd/bdd.php';
require_once '../class/User.php';
require_once '../repository/UserRepository.php';

var_dump($_GET);
var_dump($_POST);

if (isset($_POST['connexion'])) {

    // ?????????
    $hydrated = array(
        'email' => $_POST['email'],
        'mdp' => $_POST['mdp'],
    );

    $user = new User(array(
        'email' => $_POST['email'],
        'mdp' => $_POST['mdp'],
    ));

    $connexion = new UserRepository();
    $utilisateur = $connexion->login($user);

    if (!$utilisateur) {
       if (isset($_POST['reservation'])) {
           header('Location: ../../login.php?erreur=Connexion echoué&reservation='.$_POST["reservation"]);
       }
    }else{
        session_start();
        $_SESSION['user'] = $utilisateur;
        var_dump($_SESSION['user']);
        var_dump($utilisateur);
       if (isset($_POST['reservation'])){
           header('Location: ../../reservation.php?id_film='.$_POST['reservation']);
       }else{
           header('Location: ../../index.php');
       }
    }
}
if (isset($_GET['deconnexion'])) {
    session_start();
    session_destroy();
    header('Location: ../../index.php');
}
if (isset($_POST['inscription'])) {
    if ($_POST['mdp'] != $_POST['confirmeMdp']) {
        header('Location: ../../register.php?erreur=Erreur, mot de passe non confirmé !');
    }
    else {
        $hydrated = array(
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'mdp' => password_hash($_POST['mdp'] , PASSWORD_DEFAULT),
            'role' => "utilisateur"
        );
        $user = new User($hydrated);

        $inscription = new UserRepository();
        if ($inscription->register($user)){
            header('Location: ../../register.php?confirm=Vous vous êtes bien inscrit');
        }else{
            header('Location: ../../register.php?erreur=Email déjà utilisée');
        }
    }
}

if (isset($_POST['ajoutUser'])) {
        $hydrated = array(
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'mdp' => password_hash($_POST['mdp'] , PASSWORD_DEFAULT),
            'role' => $_POST['role']
        );
        $user = new User($hydrated);

        $inscription = new UserRepository();
        if ($inscription->register($user)){
            header('Location: ../../admin.php?confirm=User bien ajouté');
        }else{
            header('Location: ../../admin.php?erreur=Email déjà utilisée');
        }
}

if (isset($_POST['modifierAdmin'])) {
    $hydrated = array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'role' => $_POST['role'],
        'id_user' => $_POST['id_user']
    );
    $user = new User($hydrated);
    $modifier = new UserRepository();
    $modifier->update($user);
    header('Location: ../../admin.php?');
}

if (isset($_POST['supprimer'])){
    $hydrated = array('id_user' => $_POST['id_user']);
    $user = new User($hydrated);
    $supprimer = new UserRepository();
    $supprimer->suppProfil($user);
    header('Location: ../../admin.php?');
}