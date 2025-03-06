<?php
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
            $req = $bddUser->getBdd()->prepare('INSERT INTO utilisateur(nom, prenom, email, mdp, role,adresseFacturation) VALUES(:nom, :prenom, :email, :mdp, :role, :adresse)');
            $req->execute(array(
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'mdp' => $user->getMdp(),
                'role' => $user->getRole(),
                'adresse'=>$user->getAdresse(),
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
        if ($donnee && password_verify($connexion->getMdp(), $donnee['mdp'])) {
            $user = new User($donnee);
            return $user;
        } else {
            return false;
        }
    }

    public function update($user)
    {
        $sql = "UPDATE utilisateur 
                SET nom = :nom, prenom = :prenom, email = :email, role = :role 
                WHERE id_user = :id";
        $bddUser = new Bdd();
        $reqModif = $bddUser->getBdd()->prepare($sql);
        $reqModif->execute(array(
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
            'id' => $user->getId_user(),
        ));
        $reqModif->closeCursor();
    }
    public function updateMdp($user)
    {
        $sql = "UPDATE utilisateur 
                SET mdp = :mdp
                WHERE id_user = :id";
        $bddUser = new Bdd();
        $reqModif = $bddUser->getBdd()->prepare($sql);
        $reqModif->execute(array(
            'id' => $user->getId_user(),
            'mdp' => $user->getMdp(),
        ));
        $reqModif->closeCursor();
    }

    public function suppProfil($user)
    {
        $bddUser = new Bdd();
        $reqSupp = $bddUser->getBdd()->prepare("DELETE FROM utilisateur WHERE id_user = :id");
        $reqSupp->execute(array(
            'id' => $user->getId_user()
        ));
        $reqSupp->closeCursor();
    }

    public function listeUtilisateurs()
    {
        $bddUser = new Bdd();
        $req = $bddUser->getBdd()-> prepare('SELECT * FROM utilisateur');
        $req -> execute();
        $listeUsers = $req -> fetchAll();
        $req->closeCursor();

        return $listeUsers;
    }

    public function nombreResa($user)
    {
        $bdd = new Bdd();

        $requeteNbReserv = $bdd->getBdd()->prepare("SELECT COUNT(*) FROM `reservation` WHERE ref_user = :id_user");
        $requeteNbReserv->execute(array(
            'id_user' => $user->getId_user()
        ));
        $nbReserv = $requeteNbReserv->fetch();
        $requeteNbReserv->closeCursor();

        return $nbReserv;
    }

    public function recupId($user)
    {
        $bddUser = new Bdd();
        $req = $bddUser->getBdd()-> prepare('SELECT id_user FROM utilisateur where email = :email');
        $req->execute(array(
            'email' => $user->getEmail()
        ));
        $donnee = $req->fetch();
        return $donnee[0];

    }
    public function nombreUser()
    {
        $bddUser = new Bdd();
        $req = $bddUser->getBdd()-> prepare('SELECT COUNT(id_user) FROM utilisateur');
        $req->execute();
        $donnee = $req->fetchAll();
        return $donnee[0];
    }

}