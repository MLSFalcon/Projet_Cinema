<?php
//Ma clé d'inscription
$cle_Api = "cf24eedbfba510644a69911420fccabf";
$titre ="";
//Cherche le titre du formulaire
if(!empty($_POST["titre"])) {
    $titre = $_POST["titre"];

    // URL de la requête
    //Url de l'api + ma clé + titre
    $url = "https://api.themoviedb.org/3/search/movie?api_key=$cle_Api&query=" .urlencode($titre);
    $reponse= file_get_contents($url); //Obtenir le contenu de ma requete
    if($reponse){
        //Json_decode transforme la requête en tableau
        $data = json_decode($reponse, true);
        $film  = $data['results'][0]; //J'ai pris la 1ère version original du film


        //Concatenation du lien API + Url de l'image
        $poster  = $poster_url = "https://image.tmdb.org/t/p/w500" . $film['poster_path'];
    }
    echo "<h2> Titre : " . $titre . "</h2>";
    echo "<img src ='$poster'>";

}

   ?>
