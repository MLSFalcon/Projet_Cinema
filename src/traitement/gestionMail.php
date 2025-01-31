<?php

//use PHPMailer\PHPMailer\PHPMailer;
require '../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;


$mail = new PHPMailer(true);

//Authentification
$mail->isSMTP();
$mail->SMTPAuth = true;
//Connexion au serveur
$mail->Host = 'hoziodev.fr';
$mail->Port = 993;
$mail->Username = 'mnrt.cinema@hoziodev.fr';
$mail->Password = 'k_VHpwAv4PjC';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->charset = 'UTF-8';

//Envoie de mail
$mail->setFrom('nicolascharpentiertest@gmail.com');
$mail->addAddress($_POST['email']);
$mail->Subject = 'MNRT Cinema Réinitialisation de votre mot de passe';
$mail->Body = 'ICI SE TROUVE UN LIEN DE <b>REINITIALISATION</b> DE VOTRE MDP';
$mail->send();

header('Location: ../../index.php');

