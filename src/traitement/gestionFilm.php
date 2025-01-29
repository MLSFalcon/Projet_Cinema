<?php
//var_dump($_POST);
require_once "../bdd/Bdd.php";
require_once "../repository/FilmRepository.php";
require_once "../class/Film.php";
$action = new FilmRepository();
$titre = "";
$resume = "";
$genre = "";
$duree = "";
$image = "";

if (isset($_POST['ajoutFilm'])) {
    $hydrated = array('titre' => $_POST['titre'] ,
        'resume' => $resume,
        'genre' => $genre ,
        'duree' => $duree ,
        'image' => $image) ;
    //--------------------Manip API ----------------------------------------------
    //Ma clé d'inscription
    $cle_Api = "cf24eedbfba510644a69911420fccabf";
    $titre = $_POST['titre'];
    $url = "https://api.themoviedb.org/3/search/movie?api_key=$cle_Api&query=" . urlencode($titre);
    $reponse = file_get_contents($url); //Obtenir le contenu de ma requete
    if ($reponse) {
        //Json_decode transforme la requête en tableau
        $data = json_decode($reponse, true);
        $film = $data['results'][0]; //J'ai pris la 1ère version original du film
        $resume = $film['overview']; //Je prends le résumé du film

        //Concatenation du lien API + Url de l'image
        $image = "https://image.tmdb.org/t/p/w500" . $film['poster_path'];
        $genre = $_POST['genre'];
        $duree = $_POST['duree'];

        $film = new Film((array(
            'titre' => $_POST['titre'] ,
            'resume' => $resume ,
            'genre' => $_POST['genre'] ,
            'duree' => $_POST['duree'] ,
            'image' => $image ))) ;
        //----------------------------------------------------------------------------------//
        $ajoutFilm = new FilmRepository() ;
        $ajoutFilm -> ajouter($film);

        header("location: ../../vue/admin.php");
    }
    if (isset($_POST['supprimerFilm'])) {
        $action->supprimer($film = new Film($_POST));
        var_dump($action);
        header("location: ../../vue/admin.php");
    }
    if (isset($_POST['modifierFilm'])) {
        var_dump($_POST);
        $film = new Film($_POST);
        var_dump($film);
        $action->modifier($film);
        header("location: ../../vue/admin.php");
    }
}