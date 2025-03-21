<?php
require_once '../src/class/User.php';
session_start();
?>
<title>MNRT CINEMA - Contact</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="../asset/CSS/styleContact.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="container contact-form">
    <div class="contact-image">
        <img src="https://image.ibb.co/kUagtU/rocket_contact.png" alt="rocket_contact"/>
    </div>
    <form method="post" action="../src/traitement/gestionContact.php">
        <h3>Drop Us a Message</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="sujet" class="form-control" placeholder="Subject *" value="" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea name="explication" class="form-control" placeholder="Your Message *" style="width: 100%; height: 150px;"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="text-center">
                    <?php
                    if (isset($_GET['succes'])){
                        echo '<p style="color:limegreen">'.$_GET['succes'].'</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-12">
                <div class="text-center">
                    <a class="small" href="index.php">Retour à l'accueil.</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <input type="submit" name="btnSubmit" class="btnContact" value="Send Message" />
            </div>
        </div>
        <input type="hidden" value="<?php echo $_SESSION['user']->getId_User();?>" name="ref_user">
    </form>
</div>

