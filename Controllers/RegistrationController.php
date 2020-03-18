<?php

namespace App\Controllers;

require_once __DIR__ . "/../Interfaces/IManager.php";
require_once __DIR__ . "/../Services/PDOManager.php";
require_once __DIR__ . "/../Services/MemberManager.php";

use App\Models\Member;
use App\Services\MemberManager;

if (count($_POST) > 0) {
    $errors = [];
    if ($_POST["password"] !== $_POST["confirmPassword"]) {
        $errors[] = "Les mots de passe doivent correspondre.";
    }
    if (MemberManager::exists($_POST["email"])) {
        $errors[] = "Cet e-mail est déjà utilisé.";
    }
    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Le format de l'e-mail n'est pas valide.";
    }
    if (count($errors) === 0) {
        MemberManager::insert(new Member(0, $_POST["name"], $_POST["firstname"], $_POST["email"], $_POST["password"]));
        header("Location: login");
    }
}

require __DIR__ . "/../Views/registration_account.php";