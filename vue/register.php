<?php
require_once "../src/bdd/Bdd.php";
require_once "../src/class/User.php";

include "head.html";

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>MNRT CINEMA - Register</title>
</head>

<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image">
                    <img src="../asset/images/salle-infinite-le-grand-rex.jpg" width="100%" height="100%">
                </div>
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
                                    <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                                           placeholder="Mot de passe"
                                           name="mdp" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                           id="exampleRepeatPassword" placeholder="Confirmer le Mot de passe"
                                           name="confirmeMdp" required>
                                </div>
                            </div>

                            <!-- Critères de mot de passe -->
                            <div id="passwordRequirements" style="display:none;">
                                <ul>
                                    <li id="length" style="color: red;">- Au moins 12 caractères</li>
                                    <li id="number" style="color: red;">- 1 chiffre</li>
                                    <li id="uppercase" style="color: red;">- 1 majuscule</li>
                                    <li id="lowercase" style="color: red;">- 1 minuscule</li>
                                    <li id="special" style="color: red;">- 1 caractère spécial</li>
                                </ul>
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
                            <a class="small" href="forgot-password.php">Mot de passe oublié?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="login.php">Vous possédez déjà un compte ? Se connecter!</a>
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

<script>
    const passwordField = document.getElementById('exampleInputPassword');
    const passwordRequirements = document.getElementById('passwordRequirements');
    const lengthRequirement = document.getElementById('length');
    const numberRequirement = document.getElementById('number');
    const uppercaseRequirement = document.getElementById('uppercase');
    const lowercaseRequirement = document.getElementById('lowercase');
    const specialRequirement = document.getElementById('special');

    passwordField.addEventListener('input', function () {
        const password = passwordField.value;


        passwordRequirements.style.display = 'block';


        if (password.length >= 12) {
            lengthRequirement.style.color = 'green';
        } else {
            lengthRequirement.style.color = 'red';
        }

        if (/\d/.test(password)) {
            numberRequirement.style.color = 'green';
        } else {
            numberRequirement.style.color = 'red';
        }

        if (/[A-Z]/.test(password)) {
            uppercaseRequirement.style.color = 'green';
        } else {
            uppercaseRequirement.style.color = 'red';
        }

        if (/[a-z]/.test(password)) {
            lowercaseRequirement.style.color = 'green';
        } else {
            lowercaseRequirement.style.color = 'red';
        }

        if (/[^A-Za-z0-9]/.test(password)) {
            specialRequirement.style.color = 'green';
        } else {
            specialRequirement.style.color = 'red';
        }

        if (password.length >= 12 && /\d/.test(password) && /[A-Z]/.test(password) &&
            /[a-z]/.test(password) && /[^A-Za-z0-9]/.test(password)) {
            // Si tous les critères sont remplis, cacher les critères
            passwordRequirements.style.display = 'none';
        }
    });
</script>

</body>

</html>


