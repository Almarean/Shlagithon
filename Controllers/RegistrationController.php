<?php

namespace App\Controllers;

use App\Models\Member;
use App\Services\MemberManager;

if (count($_POST) > 0) {
    $errors = [];
    $email = $_POST["email"];
    $password = $_POST["password"];
    if (strlen($password) < 8 || !preg_match("/[0-9]+/", $password) || !preg_match("/[a-z]+/", $password) || !preg_match("/[A-Z]+/", $password)) {
        $errors[] = "Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et au minimum 8 caractères.";
    }
    if ($password !== $_POST["confirmPassword"]) {
        $errors[] = "Les mots de passe doivent correspondre.";
    }
    if (MemberManager::exists($email)) {
        $errors[] = "Cet e-mail est déjà utilisé.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Le format de l'e-mail n'est pas valide.";
    }
    if (count($errors) === 0) {
        MemberManager::insert(new Member(0, $_POST["name"], $_POST["firstname"], $email, $password));
        $verifyLink = "https://thomaslaure.alwaysdata.net/shlagithon/index.php/verify?email=";
        if (isset($_GET["env"])) {
            if ($_GET["env"] === "dev") {
                $verifyLink = "http://localhost/Shlagithon/index.php/verify?email=";
            }
        }
        $message = "Bonjour,\r\n
            Merci de vous être enregistré sur Shlagithon.\r\n
            Votre comte vient d\'être créé, vous pourrez vous connecter après avoir confirmé votre e-mail.\r\n
            Pour ce faire, veuillez cliquer sur le lien suivant :\r\n
            " . $verifyLink . $email . "&hash=" . password_hash($password, PASSWORD_DEFAULT) . "\r\n
            À bientôt !\r\n
            L'équipe de Shlagithon";
        // ini_set("SMTP", "tls://smtp.gmail.com");
        // ini_set("smtp_port", "587");
        // ini_set("SMTP", "ssl://smtp.gmail.com");
        // ini_set("smtp_port", "465");
        ini_set("SMTP", "smtp.free.fr"); // Faire fonctionner avec le SMTP Google
        ini_set("smtp_port", "25"); // Faire fonctionner avec le port SMTP de Google
        ini_set("sendmail_from", "mdesligues@gmail.com");
        $headers = "From: mdesligues@gmail.com" . "\r\n";
        $headers .= "Reply-To: mdesligues@gmail.com" . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
        if (mail($_POST["email"], "Enregistrement | Vérification", $message, $headers)) {
            header("Location: login?success=1&email=" . $email);
        } else {
            header("Location: login?success=0");
        }
    }
}

require __DIR__ . "/../Views/registration_account.php";