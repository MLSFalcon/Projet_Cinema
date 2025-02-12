<?php

class TokenRepository
{
    public function nouveauToken($token){
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('INSERT INTO token (token, ref_user) VALUES(:token, :id_user)');
        $req->execute(array(
            'token' => $token->getToken(),
            'id_user' => $token->getRefUser(),
        ));
    }

    public function verifToken($token){
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('SELECT ref_token FROM token WHERE token = :token');
        $req->execute(array(
            'token' => $token['token']
        ));
        $reponse = $req->fetch();
        if (!$reponse) {
            return false;
        }
        else{
            return true;
        }
    }

}