<?php
require_once '../class/User.php';
class UserRepository
{
    public function register($user)
    {
        $bddUser = new Bdd();
            $req = $bddUser->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
            $req->execute(array(
                'email' => $user->getEmail()
            ));
            $liste = $req->fetchAll();
            if ($liste){
                return false;
            } else{
                $req = $bddUser->getBdd()->prepare('INSERT INTO utilisateur(nom, prenom, email, mdp) VALUES(:nom, :prenom, :email, :mdp)');
                $req->execute(array(
                    'nom' => $user->getNom(),
                    'prenom' => $user->getPrenom(),
                    'email' => $user->getEmail(),
                    'mdp' => $user->getMdp(),
                ));
                $req->closeCursor();
                return true;
            }

    }

    public function login(User $connexion)
    {
        $bddUser = new Bdd();
        $req = $bddUser->getBdd()->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $req->execute(array(
            'email' => $connexion->getEmail(),
        ));
        $donnee = $req->fetch();
        var_dump($connexion);
var_dump($donnee);
        if ($donnee && password_verify($connexion->getMdp(), $donnee['mdp'])) {
            $user = new User($donnee);
            return $user;
        } else {
            return false;
        }
    }

    public function update($user)
    {
        $bddUser = new Bdd();
        $reqModif = $bddUser->getBdd()->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, role = :role WHERE id_user = :id");
        $reqModif->execute(array(
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
            'id' => $user->getId(),
        ));
        $reqModif->closeCursor();
    }

    public function suppProfil($user)
    {
        $bddUser = new Bdd();
        $reqSupp = $bddUser->getBdd()->prepare("DELETE FROM utilisateur WHERE id_user = :id");
        $reqSupp->execute(array(
            'id' => $user->getId()
        ));
        $reqSupp->closeCursor();
    }

    public function listeUsers()
    {
        $bddUser = new Bdd();
        $req = $bddUser->getBdd()-> prepare('SELECT * FROM utilisateur');
        $req -> execute();
        $listeUsers = $req -> fetchAll();

        return $listeUsers;
    }

}