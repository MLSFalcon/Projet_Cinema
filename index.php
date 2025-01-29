<?php
require_once "src/bdd/bdd.php";
require_once "src/repository/FilmRepository.php";
require_once "src/class/User.php";
$films = new FilmRepository();
$

session_start();


?>




<!DOCTYPE html>
<html data-bs-theme="dark" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>MNRT CINEMA - Index</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="asset/CSS/styles.css" rel="stylesheet" />
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
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="film.php">Films</a></li>
                <?php
                if (isset($_SESSION['user'])) {
                    echo '
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="profil.php">Profil</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="src/traitement/gestionUser.php?deconnexion=oui">Déconnexion</a></li>
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
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <?php
                    if (isset($films->listeFilms()[0]['image'])) {
                        ?>
                        <img class="img-fluid" src=<?=$films->listeFilms()[0]['image']?>>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <!-- Portfolio Item 2-->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal2">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <?php
                    if (isset($films->listeFilms()[1]['image'])) {
                        ?>
                        <img class="img-fluid" src=<?=$films->listeFilms()[1]['image']?>>
                        <?php
                    }
                    ?>

                </div>
            </div>
            <!-- Portfolio Item 3-->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal3">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <?php
                    if (isset($films->listeFilms()[2]['image'])) {
                        ?>
                        <img class="img-fluid" src=<?=$films->listeFilms()[2]['image']?>>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="row">

                <!--J'ARRIVE PAS à ALLIGNER LE BOUTON -->

                <div>
                    <form>
                        <input type="submit" class="btn btn-primary" value="Voir tout les films à l'affiche">
                    </form>
                </div>
            </div>
        </div>
</section>
<!-- Footer-->
<footer class="footer text-center">
    <div class="row">
        <div>
            <h4 class="text-uppercase mb-4">Adresse : </h4>
            <p class="lead mb-0">
                5 Av. du Général de Gaulle,
                <br />
                93440, Dugny
            </p>
        </div>
    </div>
</footer>
<!-- Portfolio Modals-->
<!-- Portfolio Modal 1-->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <div class="modal-body text-center pb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title-->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"><?=$films->listeFilms()[0]['titre']?></h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Text-->
                            <p class="mb-4">Genre : <?=$films->listeFilms()[0]['genre'] ?><br>Durée : <?=$films->listeFilms()[0]['duree'] ?><br>Résumer : <?=$films->listeFilms()[0]['resume'] ?><br> </p>
                            <div class="row">
                                <div class="col">
                                    <form action="reservation.php" method="post">
                                        <input type="hidden" name="id_film" value=<?=$films->listeFilms()[0]['id_film'] ?>>
                                        <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="Reservé une séance" name="reservation">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Portfolio Modal 2-->
<div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" aria-labelledby="portfolioModal2" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <div class="modal-body text-center pb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title-->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"><?=$films->listeFilms()[1]['titre']?></h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Text-->
                            <p class="mb-4">Genre : <?=$films->listeFilms()[1]['genre'] ?><br>Durée : <?=$films->listeFilms()[1]['duree'] ?><br>Résumer : <?=$films->listeFilms()[1]['resume'] ?><br> </p>
                            <div class="row">
                                <div class="col">
                                    <form action="reservation.php" method="post">
                                        <input type="hidden" name="id_film" value=<?=$films->listeFilms()[1]['id_film'] ?>>
                                        <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="Reservé une séance" name="reservation">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Portfolio Modal 3-->
<div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" aria-labelledby="portfolioModal3" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
            <div class="modal-body text-center pb-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Portfolio Modal - Title-->
                            <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0"><?=$films->listeFilms()[2]['titre']?></h2>
                            <!-- Icon Divider-->
                            <div class="divider-custom">
                                <div class="divider-custom-line"></div>
                                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                <div class="divider-custom-line"></div>
                            </div>
                            <!-- Portfolio Modal - Text-->
                            <p class="mb-4">Genre : <?=$films->listeFilms()[2]['genre'] ?><br>Durée : <?=$films->listeFilms()[2]['duree'] ?><br>Résumer : <?=$films->listeFilms()[2]['resume'] ?><br> </p>
                            <div class="row">
                                <div class="col">
                                    <form action="reservation.php" method="post">
                                        <input type="hidden" name="id_film" value=<?=$films->listeFilms()[2]['id_film'] ?>>
                                        <input type="submit" class="btn btn-primary" data-bs-dismiss="modal" value="Reservé une séance" name="reservation">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>
</html>