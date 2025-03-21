<?php



$resultats = [];
$adresses_uniques = [];
$adresse = "";
$adresse_api="";
if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['adresse'])){

    $adresse = $_POST["adresse"];
    $url = "https://api-adresse.data.gouv.fr/search/?q=" . urlencode($adresse) ;
    $reponse = file_get_contents($url);
    if ($reponse!==false) {
        //Json_decode transforme la requête en tableau
        $data = json_decode($reponse, true);
        foreach ($data['features'] as $ligne) {
            $adresse_api = $ligne['properties']['label'];
            similar_text(strtolower($adresse), strtolower($adresse_api), $pourcentage_ressemblance);
            if ($pourcentage_ressemblance >= 20 && !in_array($adresse_api, $adresses_uniques)) {
                $adresses_uniques [] = $adresse_api;
                $resultats[] = [
                    'code postal' => $ligne['properties']['postcode'],
                    'adresse' => $adresse_api
                ];
            }
        }
    }
    else {
        echo "<p> Erreur lors de la requête</p>";
    }
}

echo json_encode(['results' => $resultats]);




?>
