<?php
require_once "Bdd.php";
class Film
{
    private $bdd;

    public function __construct()
    {
        $this->bdd = new Bdd();
    }

    public function modifier($titre,$resume,$genre,$duree,$image,$id)
    {
        $reqModif = $this->bdd->getBdd()->prepare("UPDATE film SET image = :image, titre = :titre, resume = :resume, genre = :genre, duree = :duree WHERE id_film = :id");
        $reqModif->execute(array(
            "titre" => $titre,
            "resume" => $resume,
            "genre" => $genre,
            "duree" => $duree,
            "image" => $image,
            "id" => $id
        ));
        $reqModif->closeCursor();
    }

    public function ajouter($titre,$resume,$genre,$duree,$image)
    {
        $reqModif = $this->bdd->getBdd()->prepare("INSERT INTO film (titre, resume, genre, duree, image) VALUES (:titre, :resume, :genre, :duree, :image)");
        $reqModif->execute(array(
            "titre" => $titre,
            "resume" => $resume,
            "genre" => $genre,
            "duree" => $duree,
            "image" => $image,
        ));
        $reqModif->closeCursor();
    }

    public function supprimer($id)
    {
        $reqSupp = $this->bdd->getBdd()->prepare("DELETE FROM film WHERE id_film = :id");
        $reqSupp->execute(array(
            'id' => $id
        ));
        $reqSupp->closeCursor();
    }
}