<?php
$bdd = include '../includes/bdd.php';
if (isset($_POST['mdp'])) {
    if ($_POST['mdp'] == $_POST['confirmeMdp']) {
        $mdpchiffre = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        $req = $bdd->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $req->execute(array(
            'email' => $_POST['email']
        ));
        $liste = $req->fetchAll();
        if ($liste){
            header("location:../register.php?erreur=Le compte existe déjà");
        } else{
            var_dump($liste);
            $req = $bdd->prepare('INSERT INTO utilisateur(nom, prenom, email, mdp) VALUES(:nom, :prenom, :email, :mdp)');
            $req->execute(array(
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'email' => $_POST['email'],
                'mdp' => $mdpchiffre,
            ));
            $req->closeCursor();
            echo $mdpchiffre;
            header("location:../register.php?confirm=Inscription bien prise en compte !");
        }
    } else{
        header("location:../register.php?erreur=Les deux mot passe ne sont pas identique");
    }
}else{
    header("location:../index.php");
}
