<?php

//PAS FINIT

require_once "../src/bdd/bdd.php";
require_once "../src/repository/ReservationRepository.php";
require_once "../src/repository/SeanceRepository.php";
require_once "../src/class/User.php";
$reservation = new ReservationRepository();
$seances = new SeanceRepository();
$seances = $seances->listeSeancesFilm($_POST['id_film']);

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
                                    if (isset($_GET['reservation'])) {
                                        echo'<h1 class="h4 text-gray-900 mb-4">Veuillez vous connecter pour faire une reservation</h1>';
                                    }else{
                                        echo'<h1 class="h4 text-gray-900 mb-4">Bon retour parmis nous!</h1>';
                                    }
                                    ?>
                                </div>
                                <form class="user" method="post" action="../src/traitement/gestionUser.php">
                                    <div class="form-group">
                                        <label> Séances :
                                            <select name="ref_seance">
                                                <?php
                                                for ($i = 0; $i < count($seances); $i++) {;?>
                                                    <option value="<?= $seances[$i]['id_seance'] ?>"><?=$seances[$i]['date_seance']?>,<?=$seances[$i]['heure']?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </label>
                                    </div>
                                    <label>Places :
                                    <div class="form-group">
                                            <input type="number" name="nb_place" value="1">
                                    </div>
                                    </label>
                                    <label>
                                    <div class="form-group">
                                        <input type="number" name="" value="1">
                                    </div>
                                    </label>
                                    <input type="submit" name="connexion" class="btn btn-primary btn-user btn-block" value="Connexion">
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

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../asset/js/sb-admin-2.min.js"></script>
</body>
</html>