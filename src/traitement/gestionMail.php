<?php

//use PHPMailer\PHPMailer\PHPMailer;
require '../../vendor/autoload.php';
require_once '../class/Token.php';
require_once '../class/User.php';
require_once '../class/Token.php';
require_once '../repository/TokenRepository.php';
require_once '../repository/UserRepository.php';
require_once '../bdd/Bdd.php';
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);

$array = array(
    'email' => $_POST['email'],
);

$user = new User($array);
$userRepository = new UserRepository();
$id = $userRepository->recupId($user);

$array = array(
    'token' => generateToken(),
    'ref_user' => $id
);

$tok = new Token($array);
$tokenRep = new TokenRepository();
$tokenRep->nouveauToken($tok);

$array = explode("/",$_SERVER["REQUEST_URI"]);
$lien =$_SERVER['HTTP_ORIGIN'];
foreach ($array as $key => $value) {
    $lien= $lien.$value."/";
    if ($value=="Projet_Cinema"){
        break;
    }
}

$lien = $lien."vue/recup_password.php?recup=".$tok->getToken();

//Authentification
$mail->isSMTP();
$mail->SMTPAuth = true;
//Connexion au serveur
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->Username = 'nicolascharpentiertest@gmail.com';
$mail->Password = 'kxgbzlhrdlfzcgnp';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->charset = 'UTF-8';

//Envoie de mail
$mail->setFrom('project.hsp440@gmail.com');
$mail->addAddress($_POST['email']);
$mail->Subject = 'MNRT Cinema Réinitialisation de votre mot de passe';
$mail->Body = 'ICI SE TROUVE UN LIEN DE REINITIALISATION DE VOTRE MDP : '.$lien;
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

