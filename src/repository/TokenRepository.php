<?php

class TokenRepository
{
    public function nouveauToken($token){
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('INSERT INTO token (token, ref_user) VALUES(:token, :id_user)');
        $req->execute(array(
            'token' => $token->getToken(),
            'id_user' => $token->getRef_user(),
        ));
    }

    public function verifToken($token){
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('SELECT ref_token FROM token WHERE token = :token');
        $req->execute(array(
            'token' => $token->getToken()
        ));
        $reponse = $req->fetch();
        if (!$reponse) {
            return false;
        }
        else{
            return true;
        }
    }

    public function supprimerToken($token){
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('DELETE FROM token WHERE token = :token');
        $req->execute(array(
            'token' => $token->getToken()
        ));
    }

    public function recupRefUser($token){
        $bdd = new Bdd();
        $req= $bdd->getBdd()->prepare('SELECT ref_user FROM token WHERE token = :token');
        $req->execute(array(
            'token' => $token->getToken()
        ));
        $reponse = $req->fetch();
        var_dump($reponse);
        return $reponse['ref_user'];
    }

}