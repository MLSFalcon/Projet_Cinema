<?php

//use PHPMailer\PHPMailer\PHPMailer;
require '../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);

$token = generateToken();


//Authentification
$mail->isSMTP();
$mail->SMTPAuth = true;
//Connexion au serveur
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
//$mail->Username = 'project.hsp440@gmail.com';
//$mail->Password = 'owtansfzyivxtnmb';
$mail->Username = 'nicolascharpentiertest@gmail.com';
$mail->Password = 'kxgbzlhrdlfzcgnp';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->charset = 'UTF-8';

//Envoie de mail
$mail->setFrom('project.hsp440@gmail.com');
$mail->addAddress($_POST['email']);
$mail->Subject = 'MNRT Cinema Réinitialisation de votre mot de passe';
$mail->Body = 'ICI SE TROUVE UN LIEN DE <b>REINITIALISATION</b> DE VOTRE MDP';
try {
    $mail->send();
    echo "Message has been sent";
} catch (\PHPMailer\PHPMailer\Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

header('Location: ../../vue/index.php');

function generateToken($length = 16) {
    return bin2hex(random_bytes($length));
}

