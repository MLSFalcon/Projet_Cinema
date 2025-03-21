<?php
require_once "../src/bdd/Bdd.php";
require_once "../src/class/User.php";
require_once "../src/repository/ReservationRepository.php";
require_once "../src/repository/UserRepository.php";

include "head.html";

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}

/** @var User $User */
$User = $_SESSION['user'];
$UserRepository = new UserRepository();


//liste reservation
$listeReservation = new ReservationRepository();
$listeReservation= $listeReservation->listeReservationsUser($_SESSION['user']->getId_user());

$nbReservation = $UserRepository->nombreResa($User);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>MNRT CINEMA - Profil</title>
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

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Gestions :
        </div>


        <!-- Nav Item - Tables -->


        <li class="nav-item">
            <a class="nav-link" href="#reservations">
                <i class="fas fa-fw fa-table"></i>
                <span>Mes Reservations</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#utilisateur">
                <i class="fas fa-fw fa-table"></i>
                <span>Mon Profil</span></a>
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
                    <h1 class="h3 mb-0 text-gray-800">Mes Infos</h1>
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
                                            Total de mes réservations</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$nbReservation['COUNT(*)']?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- Content Row -->





                <!-- Gestion Réservations -->

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">MES RESERVATIONS</h6>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%;" id="reservations">
                            <thead>
                            <tr>
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
                                        <form action="../src/traitement/gestionReservation.php" method="post">
                                            <input type="hidden" name="reservation" value="<?=$listeReservation[$i]['id_reservation'] ?>" >
                                            <input class="btn btn-primary" type="submit" value="Annuler" name="annuler">
                                        </form>
                                        <br>
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
                        <h6 class="m-0 font-weight-bold text-primary" id="utilisateur">MON PROFIL</h6>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%;" id="user">
                            <thead>
                            <tr>
                                <td>prénom</td>
                                <td>nom</td>
                                <td>email</td>
                                <td>action</td>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?= $User->getNom()?>
                                    </td>
                                    <td>
                                        <?= $User->getPrenom()?>
                                    </td>
                                    <td>
                                        <?= $User->getEmail()?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modifUser">modifier</button>
                                        <br><br>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modifUser" data-backdrop="static" tabindex="-1" aria-labelledby="modifUser" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modification du Profil</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="../src/traitement/gestionUser.php">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Nom
                                                            <input style="width: 100%" type="text" class="form-control" value="<?=$User->getNom()?>" name="nom">
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Prenom
                                                            <input type="text" class="form-control" value="<?=$User->getPrenom()?>" name="prenom">
                                                        </label>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Email
                                                            <input type="email" class="form-control" value="<?=$User->getEmail()?>" name="email">
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="hidden" value="<?= $User->getId_User()?>" name="idmodif">
                                                    <input class="btn btn-primary" type="submit" value="Sauvegarder les changements" name="modifier">
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </tbody>
                        </table>
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
    new DataTable('#reservations', {
        responsive: true
    });
    new DataTable('#user', {
        responsive: true
    });
</script>
</html>



