<?php
$bdd = include "includes/bdd.php";

//Blocage de l'accès à cette page aux utilisateurs non voulu
session_start();
if ($_SESSION['role'] != "admin") {
    header("Location: index.php");
}

//Liste Utilisateurs
$requete = $bdd->prepare("SELECT id_user,nom, prenom, email, role FROM `utilisateur`");
$requete->execute();
$listeUsers = $requete->fetchAll();
$requete->closeCursor();

//Liste Films
$requete = $bdd->prepare("SELECT * FROM `film`");
$requete->execute();
$listeFilms = $requete->fetchAll();
$requete->closeCursor();

//Liste Séances
$requete = $bdd->prepare("SELECT film.titre, seance.id_seance, seance.date_seance, seance.heure, seance.nb_place_dispo, seance.ref_salle as salle  FROM `film` INNER JOIN `seance` ON film.id_film = seance.ref_film");
$requete->execute();
$listeSeances = $requete->fetchAll();
$requete->closeCursor();

//Liste Reservation
$requete = $bdd->prepare("SELECT utilisateur.email, reservation.nb_place, seance.date_seance, seance.heure, seance.ref_salle, film.titre FROM `utilisateur` INNER JOIN reservation ON utilisateur.id_user = reservation.ref_user INNER JOIN seance ON reservation.ref_seance = seance.id_seance INNER JOIN film ON seance.ref_film = film.id_film");
$requete->execute();
$listeReservations = $requete->fetchAll();
$requete->closeCursor();

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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="CSS/sb-admin-2.min.css" rel="stylesheet">
    <link href="CSS/sb-admin-2.css" rel="stylesheet">
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
                                            Pending Requests</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
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
                                        <form action="traitement/gestionFilm.php" method="post">
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
                                                        <input texte class="form-control" name="resume">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Genre
                                                        <input texte class="form-control" name="genre">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Durée
                                                        <input texte class="form-control" name="duree">
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
                            for ($i=0; $i < count($listeFilms); $i++) {
                                ?>
                                <tr>
                                    <td>
                                        <img width="125" height="150" src="<?= $listeFilms[$i]['image']?>">
                                    </td>
                                    <td>
                                        <?= $listeFilms[$i]['titre']?>
                                    </td>
                                    <td>
                                        <?= $listeFilms[$i]['resume']?>
                                    </td>
                                    <td>
                                        <?= $listeFilms[$i]['genre']?>
                                    </td>
                                    <td>
                                        <?= $listeFilms[$i]['duree']?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifFilm<?=$i?>">modifier</button>
                                        <br><br>
                                        <form action="traitement/gestionFilm.php" method="post">
                                            <input type="hidden" name="idsup" value="<?=$listeFilms[$i]['id_film']?>">
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
                                        <form action="traitement/gestionFilm.php" method="post">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Image
                                                        <input style="width: 100%" type="text" class="form-control" value="<?=$listeFilms[$i]['image']?>" name="image">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Titre
                                                        <input type="text" class="form-control" value="<?=$listeFilms[$i]['titre']?>" name="titre">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Résumé
                                                        <input texte class="form-control" value="<?=$listeFilms[$i]['resume']?>" name="resume">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Genre
                                                        <input texte class="form-control" value="<?=$listeFilms[$i]['genre']?>" name="genre">
                                                    </label>
                                                </div>
                                                <div class="form-group">
                                                    <label>Durée
                                                        <input texte class="form-control" value="<?=$listeFilms[$i]['duree']?>" name="duree">
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <input class="btn btn-primary" type="hidden" value="<?= $listeFilms[$i]['id_film']?>" name="idmodif">
                                                <input class="btn btn-primary" type="submit" value="Sauvegarder les changements" name="modifierFilm">
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
                            for ($i=0; $i < count($listeReservations); $i++) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $listeReservations[$i]['email']?>
                                    </td>
                                    <td>
                                        <?= $listeReservations[$i]['nb_place']?>
                                    </td>
                                    <td>
                                        <?= $listeReservations[$i]['date_seance']?>
                                    </td>
                                    <td>
                                        <?= $listeReservations[$i]['heure']?>
                                    </td>
                                    <td>
                                        <?= $listeReservations[$i]['titre']?>
                                    </td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="seance" >
                                            <input class="btn btn-primary" type="submit" value="modifier" name="modifier">
                                        </form>
                                        <br>
                                        <form action="" method="post">
                                            <input    type="hidden" name="seance" ">
                                            <input class="btn btn-primary" type="submit" value="supprimer">
                                        </form>
                                    </td>

                                </tr>
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
                                <form action="traitement/gestionUser.php" method="post">
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
                                        <input class="btn btn-primary" type="submit" name="ajoutUser">
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
                            for ($i=0; $i < count($listeUsers); $i++) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $listeUsers[$i]['nom']?>
                                    </td>
                                    <td>
                                        <?= $listeUsers[$i]['prenom']?>
                                    </td>
                                    <td>
                                        <?= $listeUsers[$i]['email']?>
                                    </td>
                                    <td>
                                        <?= $listeUsers[$i]['role']?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifUser<?=$i?>">modifier</button>
                                        <br><br>
                                        <form action="traitement/gestionUser.php" method="post">
                                            <input type="hidden" name="idsup" value="<?=$listeUsers[$i]['id_user']?>">
                                            <input class="btn btn-primary" type="submit" value="supprimer" name="supprimerAdmin">
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
                                            <form action="traitement/gestionUser" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nom
                                                            <input style="width: 100%" type="text" class="form-control" value="<?=$listeUsers[$i]['nom']?>" name="nom">
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Prenom
                                                            <input type="text" class="form-control" value="<?=$listeUsers[$i]['prenom']?>" name="prenom">
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Email
                                                            <input type="email" class="form-control" value="<?=$listeUsers[$i]['email']?>" name="email">
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
                                                    <input class="btn btn-primary" type="hidden" value="<?= $listeUsers[$i]['id_user']?>" name="idmodif">
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

                <!-- Gestion Séances -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row" >
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">GESTION SEANCES</h6>
                            </div>
                            <div class="col-1">
                                <form action="" method="post">
                                    <input class="btn btn-primary" type="submit" value="Ajouter une Séance">
                                </form>
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
                                <td>Place Disponible</td>
                                <td>action</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            for ($i=0; $i < count($listeSeances); $i++) {
                                ?>
                                <tr>
                                    <td>
                                        <?= $listeSeances[$i]['titre']?>
                                    </td>
                                    <td>
                                        <?= $listeSeances[$i]['date_seance']?>
                                    </td>
                                    <td>
                                        <?= $listeSeances[$i]['heure']?>
                                    </td>
                                    <td>
                                        <?= $listeSeances[$i]['salle']?>
                                    </td>
                                    <td>
                                        <?= $listeSeances[$i]['nb_place_dispo']?>
                                    </td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="seance" value=<?= $listeSeances[$i]['id_seance'] ?>>
                                            <input class="btn btn-primary" type="submit" value="modifier" name="modifier">
                                        </form>
                                        <br>
                                        <form action="" method="post">
                                            <input    type="hidden" name="seance" value="<?= $listeSeances[$i]['id_seance'] ?>">
                                            <input class="btn btn-primary" type="submit" value="supprimer">
                                        </form>
                                    </td>

                                </tr>
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
                <a class="btn btn-primary" href="traitement/gestionDeconnexion.php">Se déconnecter</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>



<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>

</body>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
<script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>
<script>
    new DataTable('#example', {
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
