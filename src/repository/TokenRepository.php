<?php

class TokenRepository
{
    public function nouveauToken($token){
        $bdd = new Bdd();
        $req = $bdd->getBdd()->prepare('INSERT INTO token (token, ref_user) VALUES(:token, :id_user)');
        $req->execute(array(
            'token' => $token['token'],
            'id_user' => $token['id_user']
        ));
    }

}