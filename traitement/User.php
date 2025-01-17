<?php
require_once "Bdd.php";

class User
{
public function __construct()
{
}

public function register($nom, $prenom, $email, $mdp, $mdpVerif)
{
    $bddUser = new Bdd();
    if ($mdp != $mdpVerif) {
        header("location:register.php?erreur=Les deux mot passe ne sont pas identique");
    }else {
        $req = $bddUser->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $req->execute(array(
            'email' => $email
        ));
        $liste = $req->fetchAll();
        if ($liste){
            header("location:register.php?erreur=Le compte existe déjà");
        } else{
            $mdpchiffre = password_hash($mdp, PASSWORD_DEFAULT);
            var_dump($liste);
            $req = $bddUser->getBdd()->prepare('INSERT INTO utilisateur(nom, prenom, email, mdp) VALUES(:nom, :prenom, :email, :mdp)');
            $req->execute(array(
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'mdp' => $mdpchiffre,
            ));
            $req->closeCursor();
            header("location:register.php?confirm=Inscription bien prise en compte !");
        }
    }

}

public function login($email, $mdp){
    $bddUser = new Bdd();
    $req = $bddUser->getBdd()-> prepare('SELECT * FROM utilisateur WHERE email = :email');
    $req -> execute(array(
        'email' => $email,
    ));
    $donnee = $req -> fetch();
    var_dump($donnee['mdp']);
    var_dump(password_verify($mdp, $donnee['mdp']));
    if ($donnee && password_verify($mdp, $donnee['mdp'])) {
        session_start();
        $_SESSION['nom'] = $donnee['nom'];
        $_SESSION['id_user'] = $donnee['id_user'];
        $_SESSION['role'] = $donnee['role'];
        header("location:index.php");
    }
    else{
        header("location:login.php?erreur=Email ou mot de passe incorrect");
    }
}

public function deconnexion()
{
    session_start();
    if(!isset($_SESSION['id_user'])){
        header('location:index.php');
    }
    session_destroy();
    header("location:index.php");
}

public function updateAdmin($nom, $prenom, $email, $role, $id)
{
    $bddUser = new Bdd();
    $reqModif = $bddUser->getBdd()->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, role = :role WHERE id_user = :id");
    $reqModif->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'role' => $role,
        'id' => $id
    ));
    $reqModif->closeCursor();
    header('location: admin.php?confirmModifUser=true#utilisateur');
}

public function update($nom, $prenom, $email, $id){
    $bddUser = new Bdd();
    $reqModif = $bddUser->getBdd()->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email WHERE id_user = :id");
    $reqModif->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'id' => $id
    ));
    $reqModif->closeCursor();
    header('location: profil.php?confirmModifUser=true#utilisateur');
}

public function ajoutAdmin($nom, $prenom, $email,$mdp ,$role)
{
    $bddUser = new Bdd();
    $mdpchiffre = password_hash($mdp, PASSWORD_DEFAULT);
    $req = $bddUser->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
    $req->execute(array(
        'email' => $email
    ));
    $liste = $req->fetchAll();
    if ($liste){
        header("location:admin.php?erreur=Le compte existe déjà");
    } else {
        var_dump($liste);
        $req = $bddUser->getBdd()->prepare('INSERT INTO utilisateur(nom, prenom, email, mdp, role) VALUES(:nom, :prenom, :email, :mdp, :role)');
        $req->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mdp' => $mdpchiffre,
            'role' => $role
        ));
        $req->closeCursor();
        header("location:admin.php?confirm=Inscription bien prise en compte !");
    }
}

public function suppAdmin($id)
{
    $bddUser = new Bdd();
    $reqSupp = $bddUser->getBdd()->prepare("DELETE FROM utilisateur WHERE id_user = :id");
    $reqSupp->execute(array(
        'id' => $id
    ));
    $reqSupp->closeCursor();
    header('location: admin.php?confirmSupUser=true#utilisateur');
}

public function suppProfil($id)
{
    $bddUser = new Bdd();
    $reqSupp = $bddUser->getBdd()->prepare("DELETE FROM utilisateur WHERE id_user = :id");
    $reqSupp->execute(array(
        'id' => $id
    ));
    $reqSupp->closeCursor();
    header('location: index.php?confirmSupUser=true#utilisateur');
}
}
