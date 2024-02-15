<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST["accepter"])) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'aboubaker.amami@esprit.tn';
    $mail->Password = 'hwqucgwumzqmatkq';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('aboubaker.amami@esprit.tn');

    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);

    $mail->Subject = "decision on retraining request";

    $mail->Body = "demande accepte";

    $mail->send();

    header('location: http://localhost/Projet/views/Backoffice/recyclage.php');
}

if (isset($_POST["refuser"])) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'aboubaker.amami@esprit.tn';
    $mail->Password = 'hwqucgwumzqmatkq';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('aboubaker.amami@esprit.tn');

    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);

    $mail->Subject = "decision on retraining request";

    $mail->Body = "demande refuser";

    $mail->send();

    header('location:http://localhost/Projet/views/Backoffice/recyclage.php');
}
