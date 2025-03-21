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




                <!-- Gestion Utilisateur-->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row" >
                            <div class="col-10">
                                <h6 class="m-0 font-weight-bold text-primary">GESTION UTILISATEUR</h6>
                            </div>
                            <div class="col-2">
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
                                    <h5 class="modal-title" id="exampleModalLabel">Ajout d'un utilisateur</h5>
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
                                            <label for="select-adresse">Adresse de facturation
                                                <select class="form-control" name="adresse" id="select-adresse" style="width:350px"></select>
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
