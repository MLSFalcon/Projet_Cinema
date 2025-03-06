<?php
require_once "../src/bdd/Bdd.php";
require_once "../src/repository/SeanceRepository.php";
require_once "../src/repository/FilmRepository.php";
require_once "../src/repository/UserRepository.php";
require_once "../src/repository/SalleRepository.php";
require_once "../src/class/User.php";
include "head.html";

//liste Séances
$listeSeance = new SeanceRepository();
$listeSeance = $listeSeance->listeSeances();
$countSeance = count($listeSeance);
//liste film
$listeFilm = new FilmRepository();
$listeFilm= $listeFilm->listeFilms();
//liste Salle
$listeSalle = new SalleRepository();
$listeSalle = $listeSalle->listeSalle();
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
    <title>MNRT CINEMA - Admin</title>

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
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="admin.php">
                <i class="fas fa-fw fa-backward "></i>
                <span>Global - Admin</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Gestions :
        </div>



        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="adminFilm.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Gestion Films</span></a>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="adminReservation.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Gestion Reservations</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="adminUser.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Gestion Utilisateurs</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="adminProduit.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Gestion Produits</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="adminContact.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Gestion Contact</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="adminSeance.php">
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

                    <!-- Pending Requests Card Example -->

                </div>

                <!-- Content Row -->

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
                                                        <select name="ref_film">
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

            <!--  Charger DataTables -->
            <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
            <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
            <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>

            <script>
                $(document).ready(function() {
                    new DataTable('#seances', { responsive: true });
                });
            </script>

</body>

</html>
