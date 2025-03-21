<?php

//PAS FINIT

require_once "../src/bdd/Bdd.php";
require_once "../src/repository/ReservationRepository.php";
require_once "../src/repository/SeanceRepository.php";
require_once "../src/class/User.php";
require_once "../src/repository/ProduitRepository.php";
require_once "../src/class/Film.php";
require_once "../src/repository/FilmRepository.php";
$reservation = new ReservationRepository();
$seances = new SeanceRepository();
$seances = $seances->listeSeancesFilm($_POST['id_film']);
$listeProduit = new ProduitRepository();
$count = new ProduitRepository();
$listeProduit = $listeProduit->listeProduit();
$count = $count->count();
include 'head.html';

session_start();
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <title>MNRT CINEMA - Réservation</title>
</head>
<body>
<body class="bg-gradient-primary">

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            <img src="../asset/images/salle-infinite-le-grand-rex.jpg" width="100%" height="100%">
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <?php
                                    $film = new Film(array(
                                        'id_film' => $_POST['id_film'],
                                    ));
                                    $filmRepository = new FilmRepository();
                                    $req = $filmRepository->afficherFilm($film);
                                    $film->hydrate($req);

                                    if (isset($_GET['reservation'])) {
                                        echo'<h1 class="h4 text-gray-900 mb-4">Veuillez vous connecter pour faire une reservation</h1>';
                                    }else{
                                        echo'<h1 class="h4 text-gray-900 mb-4">'.$film->getTitre().'</h1>';
                                    }
                                    ?>
                                </div>
                                <form class="user" method="post" action="../src/traitement/gestionReservation.php" id="reservation">
                                    <div class="form-group">
                                        <label> Séances du :
                                            <select name="ref_seance" id="select_seance" onchange="updatePlaceMax(this)">
                                                <?php
                                                $nbPlaceMaxInitiale = 0;
                                                for ($i = 0; $i < count($seances); $i++) {
                                                    if($i == 0 ){
                                                        $nbPlaceMaxInitiale = (is_null($seances[$i]['nb_place_disp']))? $seances[$i]["nb_place_salle"] : $seances[$i]['nb_place_disp'];
                                                    }
                                                    $dateOriginale = $seances[$i]['date_seance'];

                                                    $dateObj = new DateTime($dateOriginale);

                                                    $dateFormatee = $dateObj->format('d/m/Y');

                                                    ?>
                                                    <option  value="<?= $seances[$i]['id_seance'] ?>"
                                                            data-prix="<?= $seances[$i]['prix'] ?>" data-place_dispo="<?= (is_null($seances[$i]['nb_place_disp']))? $seances[$i]["nb_place_salle"] : $seances[$i]['nb_place_disp'] ?>" <?= $i === 0 ? 'selected' : '' ?>><?= $dateFormatee?> à <?= $seances[$i]['heure']?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                    <p>Prix : <span id="prix">Sélectionnez une séance</span></p>


                                    <label>Places :
                                        <div class="form-group">
                                            <input type="number" name="nb_place" value="1" id="nb_place" min="1" max="<?=$nbPlaceMaxInitiale?>">
                                        </div>
                                    </label>

                                        <div class="form-group">
                                            <label for="select-adresse">Adresse de facturation :
                                                <select class="form-control" name="adresse" id="select-adresse" style="width:350px"></select>
                                            </label>
                                        </div>
                                    <p>Produits :</p>
                                    <table>
                                        <?php
                                        for ($i = 0; $i < count($listeProduit); $i++) {

                                            ?>
                                            <tr>
                                                <td>
                                                    <label> <?= $listeProduit[$i]['nom'] ?>
                                                        <input type="checkbox" id="ref_produit<?= $i ?>" name="ref_produit<?= $i ?>" value="<?= $listeProduit[$i]['id_produit'] ?>" data-prix="<?= $listeProduit[$i]['prixProduit'] ?>" onclick="toggleQuantity(<?= $i ?>)">
                                                    </label>
                                                </td>
                                                <td>
                                                    <input id="quantite<?= $i ?>" type="number" name="quantite_produit<?= $i ?>" min="0" max="<?= $count[$i]['nb'] ?>" value="0" disabled>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>

                                    <br>
                                    <input type="hidden" name="i" value="<?=$i?>">
                                    <input type="hidden" name="ref_user" value="<?=$_SESSION['user']->getId_user()?>">
                                    <input type="submit" name="reserver" class="btn btn-primary btn-user btn-block" value="Reserver">
                                    <hr>
                                </form>
                                <div class="text-center">
                                    <a class="small" href="index.php">Retour à l'accueil.</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Footer-->
<footer class="footer text-center">
</footer>

<!--  Charger jQuery  -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!--  Charger Bootstrap -->
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!--  Charger les plugins -->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!--  Charger les scripts globaux -->
<script src="../asset/js/sb-admin-2.min.js"></script>

<!--  Charge Chart.js  -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    console.log("Version de Chart.js :", Chart?.version || "Non chargé");
</script>

<!--  Charge les scripts qui utilisent Chart.js -->
<script src="../asset/js/demo/chart-area-demo.js"></script>
<script src="../asset/js/demo/chart-pie-demo.js"></script>

<!-- Charger Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
    function toggleQuantity(index) {
        let checkbox = document.getElementById("ref_produit" + index);
        let quantityInput = document.getElementById("quantite" + index);
        if (checkbox.checked){
            quantityInput.disabled = false;
            quantityInput.value = 1;
        }else{
            quantityInput.disabled = true;
            quantityInput.value = 0;
        }
    }
</script>
<script>
    function updatePlaceMax(monSelect) {
        console.log("updatePlaceMax");
        console.log($(monSelect));
        console.log($(monSelect).find(":selected"));
        console.log($(monSelect).find(":selected").data("place_dispo"));
        $("#nb_place").attr("max", $(monSelect).find(":selected").data("place_dispo"));
    }
    function updatePrice() {

        var selectedOption = document.getElementById('select_seance').options[document.getElementById('select_seance').selectedIndex];
        var prixUnitaireSeance = parseFloat(selectedOption.getAttribute('data-prix'));
        var nbPlaces = parseInt(document.getElementById('nb_place').value);


        var prixTotalSeance = prixUnitaireSeance * nbPlaces;


        var prixTotalProduits = 0;
        var produits = document.querySelectorAll('input[type="checkbox"]:checked');

        produits.forEach(function(produit) {

            var quantiteProduit = document.getElementById('quantite' + produit.id.replace('ref_produit', '')).value;
            var prixProduit = parseFloat(produit.getAttribute('data-prix'));


            prixTotalProduits += prixProduit * quantiteProduit;
        });


        var prixTotalFinal = prixTotalSeance + prixTotalProduits;


        document.getElementById('prix').textContent = prixTotalFinal.toFixed(2) + ' €'; // Formater avec 2 décimales
    }


    document.getElementById('select_seance').addEventListener('change', updatePrice);


    document.getElementById('nb_place').addEventListener('input', updatePrice);


    document.querySelectorAll('input[type="number"]').forEach(function(input) {
        input.addEventListener('input', updatePrice);
    });

    document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
        checkbox.addEventListener('change', updatePrice);
    });

    window.onload = function() {
        updatePrice();
    };
</script>

<script>
    $(document).ready(function() {

        if ($.fn.select2) {
            console.log(" Select2 est bien chargé ");
            console.log("Élément #select-adresse détecté ?", $('#select-adresse').length);


                $('#select-adresse').select2({
                    debug: true,
                    minimumInputLength: 1,
                    dropdownParent: $('#reservation'), // pour éviter le bug dans le modal !
                    ajax: {
                        url: "../src/traitement/recherche_adresse.php",
                        type: 'POST',
                        dataType: 'json',
                        delay: 100,
                        data: function (params) {
                            return {adresse: params.term};
                        },
                        processResults: function (data) {
                            console.log(" Données reçues de l'API :", data);
                            return {
                                results: data.results.map(function (item) {
                                    return {id: item.adresse, text: item.adresse};
                                })
                            };
                        },
                        cache: true
                    }
                });

                // Supprime aria-hidden pour éviter le bug d'accessibilité
                $('#select-adresse').removeAttr('aria-hidden').attr('tabindex', '0');

        } else {
            console.error(" Erreur : Select2 n'est pas chargé.");
        }
    });

</script>

</body>
</html>