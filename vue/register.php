<?php
require_once "../src/bdd/Bdd.php";
require_once "../src/class/User.php";
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MNRT CINEMA - Register</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../asset/CSS/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Créer un compte!</h1>
                        </div>
                        <form class="user" method="post" action="../src/traitement/gestionUser.php">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                           placeholder="Prenom"
                                           name="prenom" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName"
                                           placeholder="Nom"
                                           name="nom" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                       placeholder="Adresse E-mail"
                                       name="email" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                           id="exampleInputPassword" placeholder="Mot de passe"
                                           name="mdp" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                           id="exampleRepeatPassword" placeholder="Confirmer le Mot de passe"
                                           name="confirmeMdp" required>
                                </div>
                            </div>
                            <?php
                            if (isset($_GET['erreur'])) {
                                ?>
                                <div class="form-group">
                                    <?php
                                    echo '<p style="color:red">'.$_GET['erreur'].'</p>';
                                    ?>
                                </div>
                                <?php
                            }
                            if (isset($_GET['confirm'])) {
                                ?>
                                <div class="form-group">
                                    <?php
                                    echo '<p style="color:green">'.$_GET['confirm'].'</p>';
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                            <input type="submit" name="inscription" value="Inscription" class="btn btn-primary btn-user btn-block">
                            <hr>
                        </form>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Mot de passe oublié?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="login.php">Vous posséder déja un compte ? Se connecter!</a>
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

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../asset/js/sb-admin-2.min.js"></script>

</body>

</html>
