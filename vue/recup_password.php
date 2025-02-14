<?php
require_once "../src/class/User.php";
require_once "../src/bdd/Bdd.php";
require_once "../src/class/Token.php";
require_once "../src/repository/TokenRepository.php";

include "head.html";
if (!isset($_GET['recup'])) {
    header('Location: index.php');
}
$array = array(
  'token' => $_GET['recup'],
);

$token = new Token($array);
$tokenRep = new TokenRepository();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>MNRT CINEMA - Forgot Password</title>
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
                                    <h1 class="h4 text-gray-900 mb-4">Entrez votre Mot de passe :</h1>
                                </div>
                                <form class="user" method="post" action="../src/traitement/gestionUser.php">
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                               id="exampleInputEmail" aria-describedby="emailHelp"
                                               placeholder="Nouveau mot de passe" name="mdp" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                               id="exampleInputEmail" aria-describedby="emailHelp"
                                               placeholder="Confirmer mot de passe" name="mdpverif" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="text-center">
                                            <?php
                                            if (isset($_GET['erreur'])) {
                                                echo '<p style="color:red">'.$_GET['erreur'].'</p>';
                                            }
                                            ?>
                                        </div>

                                    </div>
                                    <input type="hidden" name="token" value=<?=$token->getToken()?>>
                                    <input type="submit" name="recupmdp" class="btn btn-primary btn-user btn-block" value="Envoyer">
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
