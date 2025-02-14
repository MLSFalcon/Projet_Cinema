<?php
require_once '../bdd/bdd.php';
require_once '../class/User.php';
require_once '../repository/UserRepository.php';
require_once '../class/Token.php';
require_once '../repository/TokenRepository.php';

session_start();
/** @var User $User */
$User = $_SESSION['user'];

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
        header('Location: ../../vue/login.php?erreur=Connexion echoué');
    }else{
        session_start();
        $_SESSION['user'] = $utilisateur;
        header('Location: ../../vue/index.php');
    }
}
if (isset($_GET['deconnexion'])) {
    session_start();
    session_destroy();
    header('Location: ../../vue/index.php');
}
if (isset($_POST['inscription'])) {
    if ($_POST['mdp'] != $_POST['confirmeMdp']) {
        header('Location: ../../vue/register.php?erreur=Erreur, mot de passe non confirmé !');
    }
    elseif (!preg_match('/[A-Z]/', $_POST['mdp'])) {
        header('Location: ../../vue/register.php?erreur=Le mot de passe doit contenir au moins une majuscule');

    }
    elseif (!preg_match('/[a-z]/', $_POST['mdp'])) {
        header('Location: ../../vue/register.php?erreur=Le mot de passe doit contenir au moins une minuscule');

    }
    elseif (!preg_match('/[0-9]/', $_POST['mdp'])) {
        header('Location: ../../vue/register.php?erreur=Le mot de passe doit contenir au moins un chiffre');

    }
    elseif (!preg_match('/[\W_]/', $_POST['mdp'])) {
        header('Location: ../../vue/register.php?erreur=Le mot de passe doit contenir au moins un caractère spécial');

    }elseif (strlen($_POST['mdp']) < 12){
        header('Location: ../../vue/register.php?erreur=Le mot de passe doit contenir au 12 caractères');
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
            header('Location: ../../vue/login.php?confirm=Vous vous êtes bien inscrit');
        }else{
            header('Location: ../../vue/register.php?erreur=Email déjà utilisée');
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
        header('Location: ../../vue/admin.php?confirm=User bien ajouté');
    }else{
        header('Location: ../../vue/admin.php?erreur=Email déjà utilisée');
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
    header('Location: ../../vue/admin.php?');
}


if (isset($_POST['modifier'])) {
    $hydrated = array(
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'email' => $_POST['email'],
        'role' => $User->getRole(),
        'id_user' => $User->getId_User()
    );
    $User->hydrate($hydrated);
    $modifier = new UserRepository();
    $modifier->update($User);

    header('Location: ../../vue/profil.php?');
}

if(isset($_POST['recupmdp'])){
    if ($_POST['mdp'] != $_POST['mdpverif']) {
        header('Location: ../../vue/recup_password.php?erreur=Veuillez entrez les mêmes mots de passe&recup='.$_POST['token']);
    }elseif (!preg_match('/[A-Z]/', $_POST['mdp'])) {
        header('Location: ../../vue/recup_password.php?erreur=Le mot de passe doit contenir au moins une majuscule&recup='.$_POST['token']);

    }
    elseif (!preg_match('/[a-z]/', $_POST['mdp'])) {
        header('Location: ../../vue/recup_password.php?erreur=Le mot de passe doit contenir au moins une minuscule&recup='.$_POST['token']);

    }
    elseif (!preg_match('/[0-9]/', $_POST['mdp'])) {
        header('Location: ../../vue/recup_password.php?erreur=Le mot de passe doit contenir au moins un chiffre&recup='.$_POST['token']);

    }
    elseif (!preg_match('/[\W_]/', $_POST['mdp'])) {
        header('Location: ../../vue/recup_password.php?erreur=Le mot de passe doit contenir au moins un caractère spécial&recup='.$_POST['token']);

    }elseif (strlen($_POST['mdp']) < 12){
        header('Location: ../../vue/recup_password.php?erreur=Le mot de passe doit contenir au 12 caractères&recup='.$_POST['token']);
    }
    else{
        $tok = new Token(array(
            'token' => $_POST['token']));
        $tokenRep= new TokenRepository();

        $user = new User(array(
            'id_user' => $tokenRep->recupRefUser($tok),
            'mdp' => password_hash($_POST['mdp'] , PASSWORD_DEFAULT),
        ));

        $userRepository = new UserRepository();

        $userRepository->updateMdp($user);

        $tokenRep->supprimerToken($tok);
        header('Location: ../../vue/index.php');
    }

}