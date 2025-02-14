<?php
class FilmRepository
{

    /**
     * @param Film $film
     * @return void
     */
    public function modifier($film)
    {
        $bdd = new Bdd();
        $reqModif = $bdd->getBdd()->prepare("UPDATE film SET image = :image, titre = :titre, resume = :resume, genre = :genre, duree = :duree WHERE id_film = :id");
        $reqModif->execute(array(
            "titre" => $film->getTitre(),
            "resume" => $film->getResume(),
            "genre" => $film->getGenre(),
            "duree" => $film->getDuree(),
            "image" => $film->getImage(),
            "id" => $film->getId_film()
        ));
        $reqModif->closeCursor();
    }

    /**
     * @param Film $film
     * @return void
     */
    public function ajouter($film)
    {
        $bdd = new Bdd();
        $reqModif = $bdd->getBdd()->prepare("INSERT INTO film (titre, resume, genre, duree, image) VALUES (:titre, :resume, :genre, :duree, :image)");
        $reqModif->execute(array(
            "titre" => $film->getTitre(),
            "resume" => $film->getResume(),
            "genre" => $film->getGenre(),
            "duree" => $film->getDuree(),
            "image" => $film->getImage()
        ));
        $reqModif->closeCursor();
    }

    /**
     * @param Film $film
     * @return void
     */
    public function supprimer($film)
    {
        var_dump($film);
        $bdd = new Bdd();
        $reqSupp = $bdd->getBdd()->prepare("DELETE FROM film WHERE id_film = :id");
        $reqSupp->execute(array(
            'id' => $film->getId_film()
        ));
        $reqSupp->closeCursor();
    }
    public function listeFilms(){
        $bdd = new Bdd();
        $requete = $bdd->getBdd()->prepare("SELECT * FROM `film`");
        $requete->execute();
        $listeFilms = $requete->fetchAll();
        $requete->closeCursor();
        return $listeFilms;
    }
    public function listeFilmsSeance(){
        $bdd = new Bdd();
        $requete = $bdd->getBdd()->prepare("SELECT DISTINCT film.id_film, film.titre, film.resume, film.genre, film.duree, film.image FROM `film`
INNER JOIN seance ON film.id_film = seance.ref_film");
        $requete->execute();
        $listeFilms = $requete->fetchAll();
        $requete->closeCursor();
        return $listeFilms;
    }

    public function afficherFilm($film)
    {
        $bdd = new Bdd();
        $requete = $bdd->getBdd()->prepare("SELECT * FROM film WHERE id_film = :id");
        $requete->execute(array(
            "id" => $film->getId_film()
        ));
        $film = $requete->fetch();

        return $film;
    }
}