<?php

namespace App\Controllers;

use App\Models\Member;
use App\Services\MemberManager;

if (count($_POST) > 0) {
    $errors = [];
    if ($_POST["password"] !== $_POST["confirmPassword"]) {
        $errors["password"] = "Les mots de passe doivent correspondre.";
    }
    if (MemberManager::exists($_POST["email"])) {
        $errors["exists"] = "Cet e-mail est déjà utilisé.";
    }
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors["email_format"] = "Le format de l'e-mail n'est pas valide.";
    }
    if (count($errors) === 0) {
        MemberManager::insert(new Member(0, $_POST["name"], $_POST["firstname"], $_POST["email"], $_POST["password"]));
        header("Location: login");
    }
    require __DIR__ . "/../Views/registration_account.php";
}

require __DIR__ . "/../Views/registration_account.php";