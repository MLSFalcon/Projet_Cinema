<?php
require_once "../src/bdd/Bdd.php";
require_once "../src/repository/FilmRepository.php";
require_once "../src/class/User.php";
$films = new FilmRepository();
$listeFilm = $films->listeFilmsSeance();

include "headIndex.html";

//A OPTIMISER (JQUERY?)

session_start();


?>




<!DOCTYPE html>
<html data-bs-theme="dark" lang="fr">
<head>

    <title>MNRT CINEMA - Films</title>

</head>
<body id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="#page-top">MNRT Cinéma</a>
        <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php">Accueil</a></li>
                <?php
                if (isset($_SESSION['user'])) {
                    echo '
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="profil.php">Profil</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="../src/traitement/gestionUser.php?deconnexion=oui">Déconnexion</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="contact.php">Contact</a></li>
                    ';
                }else{
                    echo '
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="register.php">Inscription</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="login.php">Connexion</a></li>
                        ';
                }

                if (isset($_SESSION['user'])) {
                    /** @var User $User */
                    $User = $_SESSION['user'];
                    if ($User->getRole() == 'admin') {
                        echo '<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="admin.php">Admin</a></li>';
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<!-- Masthead-->
<header class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0">MNRT Cinéma</h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-circle"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
    </div>
</header>
<!-- Portfolio Section-->
<section class="page-section portfolio" id="portfolio">
    <div class="container">
        <!-- Portfolio Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Films à l'affiche</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-film"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">
            <!-- Portfolio Item 1-->
            <?php
            foreach ($listeFilm as $film) {
            ?>
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal<?=$film["id_film"]?>">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                        <img class="img-fluid" src=<?=$film['image']?>>
                </div>
            </div>
            <?php
            }
            ?>
        </div>

    </div>
</section>
<!-- Footer-->
<footer class="footer text-center">
    <div class="row">
        <div>
            <h4 class="text-uppercase mb-4">Adresse : </h4>
            <p class="lead mb-0">
                Boulevard Poissonière,Quartier du Mail,
                <br />
                Paris 2e Arrondissement, Paris Île-de-France,
                <br />
                France métropolitaine, 75002, France
            </p>
            <iframe width="425" height="350" src="https://www.openstreetmap.org/export/embed.html?bbox=2.3464018106460576%2C48.87005903250478%2C2.3482257127761845%2C48.871008202802116&amp;layer=mapnik" style="border: 1px solid black"></iframe><br/><small><a href="https://www.openstreetmap.org/#map=19/48.870534/2.347314">Afficher une carte plus grande</a></small>
            </p>
        </div>
    </div>
</footer>
<!-- Portfolio Modals-->

<?php
foreach ($listeFilm as $film) {
?>

<div class="portfolio-modal modal fade" id="portfolioModal<?=$film['id_film']?>" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <div class="modal-body text-center pb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title-->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"><?=$film['titre']?></h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Text-->
                            <p class="mb-4">Genre : <?=$film['genre'] ?><br>Durée : <?=$film['duree'] ?><br>Résumé : <?=$film['resume'] ?><br> </p>
                            <div class="row">
                                <div class="col">
                                    <?php
                                    if (!isset($_SESSION['user'])){?>
                                        <p>Veuillez vous connecter pour réserver</p>
                                    <?php } else {?>
                                        <form action="reservation.php" method="post">
                                            <input type="hidden" name="id_film" value=<?=$film['id_film'] ?>>
                                            <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="Reservé une séance" name="reservation">
                                        </form>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
}
?>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="../asset/js/scripts.js"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

