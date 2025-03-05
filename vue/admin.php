<?php
require_once "../src/bdd/Bdd.php";
require_once "../src/repository/FilmRepository.php";
require_once "../src/repository/ReservationRepository.php";
require_once "../src/repository/UserRepository.php";
require_once "../src/repository/SeanceRepository.php";
require_once "../src/repository/SalleRepository.php";
require_once "../src/repository/ContactRepository.php";
require_once "../src/repository/ProduitRepository.php";
require_once "../src/class/User.php";

include "head.html";

//liste film
$listeFilm = new FilmRepository();
$listeFilm= $listeFilm->nombreFilm();
//liste reservation
$listeReservation = new ReservationRepository();
$listeReservation= $listeReservation->nombreResa();
//liste Users
$listeUser = new UserRepository();
$listeUser = $listeUser->nombreUser();
//liste Séances
$listeSeance = new SeanceRepository();
$listeSeance = $listeSeance->nombreSeance();
//liste Salle
$listeSalle = new SalleRepository();
$listeSalle = $listeSalle->nombreSalle();
//liste contact
$listeContact = new ContactRepository();
$listeContact = $listeContact->listeContacts();
$nbContact = new ContactRepository();
//nombre de requete
$nbContact = $nbContact->countContact();
//liste produit
$listeProduit = new ProduitRepository();
$count = new ProduitRepository();
$listeProduit = $listeProduit->listeProduit();
$count = $count->count();
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

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Gestions :
        </div>
        <li class="nav-item">
            <a class="nav-link" href="admin.php">
                <i class="fas fa-fw fa-table"></i>
                <span>Globale</span></a>
        </li>


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
            <a class="nav-link" href="adminUtilisateur.php">
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
            <a class="nav-link" href="adminSeances.php">
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
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Quantité produits sucrés</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count['2']['nb'] ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-apple-alt fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Quantité produits salés</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count['1']['nb'] ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-bacon fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Boissons</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count['0']['nb'] ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-cocktail fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Nombre de réservation</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $listeReservation[0] ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Nombre de film</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $listeFilm[0] ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-film fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Nombre de séance</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $listeSeance[0] ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-school fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Nombre d'utilisateur</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $listeUser[0] ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Nombre de Salle</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $listeSalle[0] ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-house-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Content Row -->


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
>>>>>>> e826176e0afe7a3a0031da9c39cbf41ae22fb499
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

                <!-- Charger Select2 -->
                <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
                <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

                <script>
                    $(document).ready(function() {

                        if ($.fn.select2) {
                            console.log(" Select2 est bien chargé ");
                            console.log("Élément #select-adresse détecté ?", $('#select-adresse').length);

                            // Initialisation de Select2 uniquement à l'ouverture du modal
                            $('#ajoutUser').on('shown.bs.modal', function () {
                                console.log("Modal affiché,lancement de Select2");

                                $('#select-adresse').select2({
                                    debug: true,
                                    minimumInputLength: 1,
                                    dropdownParent: $('#ajoutUser'), // pour éviter le bug dans le modal !
                                    ajax: {
                                        url: "../src/traitement/recherche_adresse.php",
                                        type: 'POST',
                                        dataType: 'json',
                                        delay: 100,
                                        data: function (params) {
                                            return {adresse: params.term};
                                        },
                                        processResults: function (data) {
                                            console.log(" Données reçues de l'API :", data);
                                            return {
                                                results: data.results.map(function (item) {
                                                    return {id: item.adresse, text: item.adresse};
                                                })
                                            };
                                        },
                                        cache: true
                                    }
                                });

                                // Supprime aria-hidden pour éviter le bug d'accessibilité
                                $('#select-adresse').removeAttr('aria-hidden').attr('tabindex', '0');
                            });

                        } else {
                            console.error(" Erreur : Select2 n'est pas chargé.");
                        }
                    });

                </script>

                <!--  Charger DataTables -->
                <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
                <script src="https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.js"></script>
                <script src="https://cdn.datatables.net/responsive/3.0.3/js/responsive.dataTables.js"></script>

                <script>
                    $(document).ready(function() {
                        new DataTable('#example', { responsive: true });
                        new DataTable('#contact', { responsive: true });
                        new DataTable('#reservations', { responsive: true });
                        new DataTable('#seances', { responsive: true });
                        new DataTable('#films', { responsive: true });
                        new DataTable('#produit', { responsive: true });
                    });
                </script>

</body>

</html>
