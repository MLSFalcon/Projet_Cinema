<?php
require_once "Bdd.php";

class User
{
public function __construct()
{
}

public function register($nom, $prenom, $email, $mdp, $mdpVerif)
{
    $bdd = new Bdd();
    if ($mdp != $mdpVerif) {
        header("location:../register.php?erreur=Les deux mot passe ne sont pas identique");
    }else {
        $req = $bdd->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $req->execute(array(
            'email' => $email
        ));
        $liste = $req->fetchAll();
        if ($liste){
            header("location:../register.php?erreur=Le compte existe déjà");
        } else{
            $mdpchiffre = password_hash($mdp, PASSWORD_DEFAULT);
            var_dump($liste);
            $req = $bdd->getBdd()->prepare('INSERT INTO utilisateur(nom, prenom, email, mdp) VALUES(:nom, :prenom, :email, :mdp)');
            $req->execute(array(
                'nom' => $nom,
                'prenom' => $prenom,
                'email' => $email,
                'mdp' => $mdpchiffre,
            ));
            $req->closeCursor();
            header("location:../register.php?confirm=Inscription bien prise en compte !");
        }
    }

}


}