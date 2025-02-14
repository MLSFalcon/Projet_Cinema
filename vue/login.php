<?php
require_once "../src/class/User.php";
require_once "../src/bdd/Bdd.php";

include "head.html";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>MNRT CINEMA - Login</title>
</head>

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
                                        <input type="email" class="form-control form-control-user"
                                               id="exampleInputEmail" aria-describedby="emailHelp"
                                               placeholder="Entrez une adresse email" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                               id="exampleInputPassword" placeholder="Mot de Passe"
                                               name="mdp" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="text-center">
                                            <?php
                                            if (isset($_GET['erreur'])) {
                                                echo '<p style="color:red">'.$_GET['erreur'].'</p>';
                                            }
                                            ?>
                                            <?php

                            if (isset($_GET['confirm'])) {
                                ?>
                                                <?php
                                                echo '<p style="color:green">'.$_GET['confirm'].'</p>';
                                                ?>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_GET['reservation'])) {?>
                                        <input type="hidden" name="reservation" value=<?=$_GET["reservation"]?>>
                                    <?php
                                    }?>

                                    <input type="submit" name="connexion" class="btn btn-primary btn-user btn-block" value="Connexion">
                                    <hr>
                                </form>

                                <div class="text-center">
                                    <a class="small" href="forgot-password.php">Mot de passe oublié?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="register.php">Créer un compte!</a>
                                </div>
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

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../asset/js/sb-admin-2.min.js"></script>

</body>

</html>
