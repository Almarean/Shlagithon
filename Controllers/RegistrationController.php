<?php

namespace App\Controllers;

use App\Models\Member;
use App\Services\MemberManager;
use PHPMailer\PHPMailer\PHPMailer;

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
    if (!count($errors) > 0) {
        $member = new Member(0, $_POST["name"], $_POST["firstname"], $email, $password, "MEMBER");
        MemberManager::insert($member);
        $verifyLink = "http://localhost/Shlagithon/index.php/verify?email=";
        // $verifyLink = "https://thomaslaure.alwaysdata.net/Shlagithon/index.php/verify?email=";
        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'mdesligues@gmail.com';
        $mail->Password = '$$MaisonDesLigues2018';
        $mail->SetFrom('mdesligues@gmail.com');
        $mail->Subject = 'Vérification de compte';
        $mail->Body = "<p>Bonjour,</p>
            <p>Merci de vous être enregistré sur Patoketchup.</p>
            <p>Votre compte vient d'être créé, vous pourrez vous connecter après avoir confirmé votre e-mail.</p>
            <p>Pour ce faire, veuillez cliquer sur le lien suivant :</p>
            <p>" . $verifyLink . $email . "&hash=" . password_hash($password, PASSWORD_DEFAULT) . "</p>
            <p>À bientôt !</p>
            <p>L'équipe de Patoketchup</p>";
        $mail->AddAddress($email);
        if ($mail->send()) {
            echo $twig->render("login.twig", [
                "email" => $email,
                "success" => 1
            ]);
            // header("Location: login?success=1&email=" . $email);
        } else {
            echo $twig->render("login.twig", [
                "success" => 0
            ]);
            // header("Location: login?success=0");
        }
    }
}

require __DIR__ . "/../Views/registration_account.php";