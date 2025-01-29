<?php
require_once "../src/bdd/Bdd.php";
require_once "../src/repository/FilmRepository.php";
require_once "../src/repository/ReservationRepository.php";
require_once "../src/repository/UserRepository.php";
require_once "../src/repository/SeanceRepository.php";
require_once "../src/repository/SalleRepository.php";
require_once "../src/repository/ContactRepository.php";
require_once "../src/class/User.php";
//liste film
$listeFilm = new FilmRepository();
$listeFilm= $listeFilm->listeFilms();
//liste reservation
$listeReservation = new ReservationRepository();
$listeReservation= $listeReservation->listeReservations();
//liste Users
$listeUser = new UserRepository();
$listeUser = $listeUser->listeUtilisateurs();
//liste Séances
$listeSeance = new SeanceRepository();
$listeSeance = $listeSeance->listeSeances();
//liste Salle
$listeSalle = new SalleRepository();
$listeSalle = $listeSalle->listeSalle();
//liste contact
$listeContact = new ContactRepository();
$listeContact = $listeContact->listeContacts();
$nbContact = new ContactRepository();
//nombre de requete
$nbContact = $nbContact->countContact();
//Blocage de l'accès à cette page aux utilisateurs non voulu
session_start();
if (isset($_SESSION['user'])) {
    /** @var User $User */
    $User = $_SESSION['user'];
    if ($User->getRole() != 'admin') {
        header("location: index.php");
    }
}else{
    header("location: index.php");
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>MNRT CINEMA - Page Admin</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../asset/CSS/sb-admin-2.min.css" rel="stylesheet">
    <link href="../asset/CSS/sb-admin-2.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css" rel="stylesheet">


</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-film"></i>
            </div>
            <div class="sidebar-brand-text mx-3">MNRT Cinema</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            Liens :
        </div>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-backward "></i>
                <span>Accueil</span></a>
            <a class="nav-link" href="login.php">
                <i class="fas fa-fw fa-circle "></i>
                <span>Connexion</span></a>
            <a class="nav-link" href="register.php">
                <i class="fas fa-fw fa-square "></i>
                <span>Inscription</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Gestions :
        </div>



        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="#films">
                <i class="fas fa-fw fa-table"></i>
                <span>Gestion Films</span></a>
        </li>

        <!-- Nav Item - Tables -->


        <li class="nav-item">
            <a class="nav-link" href="#reservations">
                <i class="fas fa-fw fa-table"></i>
                <span>Gestion Reservations</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#utilisateur">
                <i class="fas fa-fw fa-table"></i>
                <span>Gestion Utilisateurs</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#seances">
                <i class="fas fa-fw fa-table"></i>
                <span>Gestion Seances</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>


    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>



                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <a  class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Déconnexion
                    </a>


                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Earnings (Monthly)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Earnings (Annual)</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-info" role="progressbar"
                                                         style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                         aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Nombre de demande</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $nbContact['nombre'] ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Content Row -->

                <!-- Gestion Film -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row" >
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">GESTION FILMS</h6>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutFilm">Ajouter un Film</button>
                            </div>
                            <div class="modal fade" id="ajoutFilm" data-backdrop="static" tabindex="-1" aria-labelledby="ajoutFilm" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ajout d'un Film</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="../src/traitement/gestionFilm.php">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Image
                                                        <input style="width: 100%" type="text" class="form-control" name="image">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Titre
                                                        <input type="text" class="form-control" name="titre">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Résumé
                                                        <input type="text" class="form-control" name="resume">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Genre
                                                        <input type="text" class="form-control" name="genre">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Durée
                                                        <input type="text" class="form-control" name="duree">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <input class="btn btn-primary" type="submit" value="Envoyer" name="ajoutFilm">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%;" id="films">
                            <thead>
                            <tr>
                                <td>image</td>
                                <td>titre</td>
                                <td>resume</td>
                                <td>genre</td>
                                <td>duree</td>
                                <td>action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($i=0; $i < count($listeFilm); $i++) {

                            ?>
                            <tr>
                                <td>
                                    <img width="125" height="150" src="<?= $listeFilm[$i]['image']?>" alt="">
                                </td>
                                <td>
                                    <?= $listeFilm[$i]['titre']?>
                                </td>
                                <td>
                                    <?= $listeFilm[$i]['resume']?>
                                </td>
                                <td>
                                    <?= $listeFilm[$i]['genre']?>
                                </td>
                                <td>
                                    <?= $listeFilm[$i]['duree']?>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifFilm<?=$i?>">modifier</button>
                                    <br><br>
                                    <form method="post" action="../src/traitement/gestionFilm.php">
                                        <input type="hidden" name="id_film" value="<?=$listeFilm[$i]['id_film']?>">
                                        <input class="btn btn-primary" type="submit" value="supprimer" name="supprimerFilm">
                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="modifFilm<?=$i?>" data-backdrop="static" tabindex="-1" aria-labelledby="modifFilm" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modification du Profil</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="../src/traitement/gestionFilm.php">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Image
                                                        <input style="width: 100%" type="text" class="form-control" value="<?=$listeFilm[$i]['image']?>" name="image">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Titre
                                                        <input type="text" class="form-control" value="<?=$listeFilm[$i]['titre']?>" name="titre">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Résumé
                                                        <input type="text" class="form-control" value="<?=$listeFilm[$i]['resume']?>" name="resume">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Genre
                                                        <input type="text" class="form-control" value="<?=$listeFilm[$i]['genre']?>" name="genre">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Durée
                                                        <input type="text" class="form-control" value="<?=$listeFilm[$i]['duree']?>" name="duree">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <input class="btn btn-primary" type="hidden" value="<?= $listeFilm[$i]['id_film']?>" name="id_film">
                                                <input class="btn btn-primary" type="submit" value="Sauvegarder les changements" name="modifierFilm">
                                            </div>
                                        </form>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            </tbody>
                        </table>
                    </div>
                </div>




                <!-- Gestion Réservations -->

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row" >
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">GESTION RESERVATIONS</h6>
                            </div>
                            <div class="col-1">
                                <form action="" method="post">
                                    <input class="btn btn-primary" type="submit" value="Ajouter une Séance">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%;" id="reservations">
                            <thead>
                            <tr>
                                <td>Utilisateurs</td>
                                <td>Places</td>
                                <td>Date</td>
                                <td>Heure</td>
                                <td>Film</td>
                                <td>action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($i=0; $i < count($listeReservation); $i++) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $listeReservation[$i]['email']?>
                                    </td>
                                    <td>
                                        <?= $listeReservation[$i]['nb_place']?>
                                    </td>
                                    <td>
                                        <?= $listeReservation[$i]['date_seance']?>
                                    </td>
                                    <td>
                                        <?= $listeReservation[$i]['heure']?>
                                    </td>
                                    <td>
                                        <?= $listeReservation[$i]['titre']?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifReservation<?=$i?>">modifier</button>
                                        <br><br>
                                        <form action="../src/traitement/gestionReservation.php" method="post">
                                            <input type="hidden" name="id_reservation" value="<?=$listeReservation[$i]['id_reservation']?>">
                                            <input class="btn btn-primary" type="submit" value="supprimer">
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modifReservation<?=$i?>" data-backdrop="static" tabindex="-1" aria-labelledby="modifReservation" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modification du Profil</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="../src/traitement/gestionUser.php" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nombre de places
                                                            <input style="width: 100%" type="text" class="form-control" value="<?=$listeReservation[$i]['nb_place']?>" name="nb_place">
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Id User
                                                            <input type="text" class="form-control" value="<?=$listeReservation[$i]['ref_user']?>" name="prenom">
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Film
                                                            <input type="email" class="form-control" value="<?=$listeReservation[$i]['titre']?>" name="email">
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input class="btn btn-primary" type="hidden" value="<?= $listeReservation[$i]['id_reservation']?>" name="id_user">
                                                    <input class="btn btn-primary" type="submit" value="Sauvegarder les changements" name="modifierAdmin">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Gestion Utilisateur-->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row" >
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">GESTION UTILISATEUR</h6>
                            </div>
                            <div class="col-1">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutUser">Ajouter un utilisateur</button>
                                <?php
                                if (isset($_GET['erreur'])) {
                                    echo '<p style="color:red">'.$_GET['erreur'].'</p>';
                                }
                                if (isset($_GET['confirm'])) {
                                    echo '<p style="color:green">'.$_GET['confirm'].'</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="ajoutUser" data-backdrop="static" tabindex="-1" aria-labelledby="ajoutUser" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modification du Profil</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="../src/traitement/gestionUser.php" method="post">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nom
                                                <input style="width: 100%" type="text" class="form-control" name="nom" required>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>Prenom
                                                <input type="text" class="form-control" name="prenom" required>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>Address Email
                                                <input type="email" class="form-control" name="email" required>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>Mot de passe
                                                <input type="password" class="form-control" name="mdp" required>
                                            </label>
                                        </div>
                                        <label>Rôle
                                            <select class="form-control" name="role" >
                                                <option>utilisateur</option>
                                                <option>admin</option>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input class="btn btn-primary" type="submit" name="ajoutUser" value="Ajouter"">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%;" id="example">
                            <thead>
                            <tr>
                                <td>prénom</td>
                                <td>nom</td>
                                <td>email</td>
                                <td>rôle</td>
                                <td>action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($i=0; $i < count($listeUser); $i++) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $listeUser[$i]['nom']?>
                                    </td>
                                    <td>
                                        <?= $listeUser[$i]['prenom']?>
                                    </td>
                                    <td>
                                        <?= $listeUser[$i]['email']?>
                                    </td>
                                    <td>
                                        <?= $listeUser[$i]['role']?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifUser<?=$i?>">modifier</button>
                                        <br><br>
                                        <form action="../src/traitement/gestionUser.php" method="post">
                                            <input type="hidden" name="id_user" value="<?=$listeUser[$i]['id_user']?>">
                                            <input class="btn btn-primary" type="submit" value="supprimer" name="supprimer">
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modifUser<?=$i?>" data-backdrop="static" tabindex="-1" aria-labelledby="modifUser" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modification du Profil</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="../src/traitement/gestionUser.php" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nom
                                                            <input style="width: 100%" type="text" class="form-control" value="<?=$listeUser[$i]['nom']?>" name="nom">
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Prenom
                                                            <input type="text" class="form-control" value="<?=$listeUser[$i]['prenom']?>" name="prenom">
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Email
                                                            <input type="email" class="form-control" value="<?=$listeUser[$i]['email']?>" name="email">
                                                        </label>
                                                    </div>
                                                    <label>Rôle
                                                        <select class="form-control" name="role">
                                                            <option value="utilisateur">utilisateur</option>
                                                            <option value="admin">admin</option>
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input class="btn btn-primary" type="hidden" value="<?= $listeUser[$i]['id_user']?>" name="id_user">
                                                    <input class="btn btn-primary" type="submit" value="Sauvegarder les changements" name="modifierAdmin">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Gestion Contact -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row" >
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">GESTION CONTACT</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%;" id="contact">
                            <thead>
                            <tr>
                                <td>sujet</td>
                                <td>explication</td>
                                <td>utilisateur</td>
                                <td>action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($i=0; $i < count($listeContact); $i++) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $listeContact[$i]['sujet']?>
                                    </td>
                                    <td>
                                        <?= $listeContact[$i]['explication']?>
                                    </td>
                                    <td>
                                        <?= $listeContact[$i]['email']?>
                                    </td>
                                    <td>
                                        <form action="../src/traitement/gestionContact.php" method="post">
                                            <input type="hidden" name="id_contact" value="<?=$listeContact[$i]['id_contact']?>">
                                            <input class="btn btn-primary" type="submit" value="supprimer" name="supprimer">
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Gestion Séances -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row" >
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">GESTION SEANCES</h6>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ajoutSeance">Ajouter une séance</button>
                            </div>
                            <div class="modal fade" id="ajoutSeance" data-backdrop="static" tabindex="-1" aria-labelledby="ajoutSeance" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ajout d'une séance</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="../src/traitement/gestionSeance.php" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Film
                                                        <select name="ref_film"  required> <!-- METTRE VALEUR PAR DEFAUT CELLE QUI A ECRIS -->
                                                            <?php for ($j = 0 ; $j < count($listeFilm); $j++ ) {
                                                                ?>
                                                                <option value="<?= $listeFilm[$j]['id_film'] ?>"><?= $listeFilm[$j]['titre'] ?> </option>
                                                                <?php
                                                            } ?>
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Date
                                                        <input type="date" class="form-control" name="date_seance" required>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Heure
                                                        <input type="text" class="form-control" name="heure" required>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Salle
                                                        <select name="ref_salle" required> <!-- METTRE VALEUR PAR DEFAUT CELLE QUI A ECRIS -->
                                                            <?php for ($j = 0 ; $j < count($listeSalle); $j++ ) {
                                                                ?>
                                                                <option><?= $listeSeance[$j]['salle'] ?> </option>
                                                                <?php
                                                            } ?>
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Prix
                                                        <input type class="form-control" name="prix" required>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <input class="btn btn-primary" type="submit" value="Envoyer" name="ajoutSeance">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%;" id="seances">
                            <thead>
                            <tr>
                                <td>Film</td>
                                <td>Date</td>
                                <td>Heure</td>
                                <td>Salle</td>
                                <td>Prix</td>
                                <td>action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($i=0; $i < count($listeSeance); $i++) {
                            ?>
                            <tr>
                                <td>
                                    <?= $listeSeance[$i]['titre']?>
                                </td>
                                <td>
                                    <?= $listeSeance[$i]['date_seance']?>
                                </td>
                                <td>
                                    <?= $listeSeance[$i]['heure']?>
                                </td>
                                <td>
                                    <?= $listeSeance[$i]['salle']?>
                                </td>
                                <td>
                                    <?= $listeSeance[$i]['prix']?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifSeance<?=$i?>">modifier</button>
                                    <br><br>
                                    <form action="../src/traitement/gestionSeance.php" method="post">
                                        <input type="hidden" name="id_seance" value="<?=$listeSeance[$i]['id_seance']?>">
                                        <input class="btn btn-primary" type="submit" value="supprimer" name="supprimerSeance">
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="modifSeance<?=$i?>" data-backdrop="static" tabindex="-1" aria-labelledby="modifSeance" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modification de la séance</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="../src/traitement/gestionSeance.php" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Titre
                                                        <select name="ref_film"> <!-- METTRE VALEUR PAR DEFAUT CELLE QUI A ECRIS -->
                                                            <?php for ($j = 0 ; $j < count($listeFilm); $j++ ) {
                                                                ?>
                                                                <option value="<?= $listeFilm[$j]['id_film'] ?>"><?= $listeFilm[$j]['titre'] ?> </option>
                                                                <?php
                                                            } ?>
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Date
                                                        <input type="date" class="form-control" value="<?=$listeSeance[$i]['date_seance']?>" name="date_seance">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Heure
                                                        <input type="text" class="form-control" value="<?=$listeSeance[$i]['heure']?>" name="heure">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Salle
                                                        <select name="ref_salle"> <!-- METTRE VALEUR PAR DEFAUT CELLE QUI A ECRIS -->
                                                            <?php for ($j = 0 ; $j < count($listeSalle); $j++ ) {
                                                                ?>
                                                                <option><?= $listeSeance[$j]['salle'] ?> </option>
                                                                <?php
                                                            } ?>
                                                        </select>
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Prix
                                                        <input type="text" class="form-control" value="<?=$listeSeance[$i]['prix']?>" name="prix">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <input class="btn btn-primary" type="hidden" value="<?= $listeSeance[$i]['id_seance']?>" name="id_seance">
                                                <input class="btn btn-primary" type="submit" value="Sauvegarder les changements" name="modifierSeance">
                                            </div>
                                            </tr>
                                        </form>

                                        <?php
                                        } ?>
                                    </div>
                                </div>



                            </div>
                            <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

                    <!-- Footer -->
                    <footer class="sticky-footer bg-white">
                    </footer>
                    <!-- End of Footer -->

                </div>
                <!-- End of Content Wrapper -->


            </div>

            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Prèt à partir ?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Selectionnez se déconnecter pour quitter votre session</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                            <a class="btn btn-primary" href="../src/traitement/gestionUser.php?deconnexion=oui">Se déconnecter</a>
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

            <!-- Page level plugins -->
            <script src="../vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="../asset/js/demo/chart-area-demo.js"></script>
            <script src="../asset/js/demo/chart-pie-demo.js"></script>

</body>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>
<script>
    new DataTable('#example', {
        responsive: true
    });
    new DataTable('#contact', {
        responsive: true
    });
    new DataTable('#reservations', {
        responsive: true
    });
    new DataTable('#seances', {
        responsive: true
    });
    new DataTable('#films', {
        responsive: true
    });
</script>
</html>