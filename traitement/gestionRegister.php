<?php
$bdd = new PDO('mysql:host=localhost;port=3307;dbname=mnrt_cinema;charset=utf8','root',''   );
if (isset($_POST['mdp'])) {
    if ($_POST['mdp'] == $_POST['confirmeMdp']) {

        $req = $bdd->prepare('SELECT email FROM utilisteur WHERE email = :email');
        $req->execute(array(
            'email' => $_POST['email']
        ));
        $liste = $req->fetch();
        if ($liste){
            header("location:../register.php?erreur=Le compte existe déjà");
        } else{
            $req = $bdd->prepare('INSERT INTO utilisateur(nom, prenom, email, mdp) VALUES(:nom, :prenom, :email, :mdp)');
            $req->execute(array(
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'email' => $_POST['email'],
                'mdp' => $_POST['mdp'],
            ));
            $req->closeCursor();
            header("location:../register.php?confirm=Inscription bien prise en compte !");
        }
    } else{
        header("location:../register.php?erreur=Les deux mot passe ne sont pas identique");
    }
}
