<?php
require_once '../bdd/bdd.php';
require_once '../class/User.php';
require_once '../repository/UserRepository.php';

var_dump($_GET);

if (isset($_POST['connexion'])) {
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

    var_dump($utilisateur);

    if (!$utilisateur) {
       header('Location: ../../login.php?erreur=Connexion echoué');
    }else{
        session_start();
        $_SESSION['user'] = $utilisateur;
       header('Location: ../../index.php');
    }
}
if (isset($_GET['deconnexion'])) {
    session_start();
    session_destroy();
    header('Location: ../../index.php');
}
if (isset($_POST['inscription'])) {
    if ($_POST['mdp'] != $_POST['mdpConfirmer']) {
        header('Location: ../../register.php?erreur=Erreur, mot de passe non confirmé !');
    }
    else {
        $hydrated = array(
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'mdp' => password_hash($_POST['mdp'] , PASSWORD_DEFAULT),
        );
        $user = new User($hydrated);
        $inscription = new User($hydrated);
    }
}
?>
