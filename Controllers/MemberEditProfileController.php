<?php

namespace App\Controllers;

use App\Services\MemberManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
}
$memberConnected = unserialize($_SESSION["member"]);
$member = $memberConnected;
if (!$memberConnected->getIsConfirmed()) {
    header("Location: logout");
}

$memberId = MemberManager::findIdBy($memberConnected->getEmail());

if (isset($_POST["name"]) && isset($_POST["firstname"]) && isset($_POST["email"])) {
    $errors = [];
    $email = $_POST["email"];
    $password = trim($_POST["password"]);

    if (MemberManager::exists($email)) {
        $errors[] = "Cet e-mail est déjà utilisé.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Le format de l'e-mail n'est pas valide.";
    }

    if (strlen($password) > 0) {
        if (strlen($password) < 8 || !preg_match("/[0-9]+/", $password) || !preg_match("/[a-z]+/", $password) || !preg_match("/[A-Z]+/", $password)) {
            $errors[] = "Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et au minimum 8 caractères.";
        }
        if ($password !== $_POST["confirmPassword"]) {
            $errors[] = "Les mots de passe doivent correspondre.";
        }
    }

    if (!count($errors) > 0) {
        $memberConnected->setName($_POST["name"]);
        $memberConnected->setFirstname($_POST["firstname"]);
        $memberConnected->setEmail($email);
        $memberConnected->setPassword($password);
        if (strlen($password) > 0) {
            $memberConnected->setPassword($password);
            MemberManager::updateMember($memberId, $memberConnected->getName(), $memberConnected->getFirstname(), $memberConnected->getEmail(), "MEMBER", $memberConnected->getPassword());
        } else {
            MemberManager::updateMember($memberId, $memberConnected->getName(), $memberConnected->getFirstname(), $memberConnected->getEmail(), "MEMBER");
        }
        $_SESSION["member"] = serialize($memberConnected);
        header("Location: profile?success=1");
    }
}

require __DIR__ . "/../Views/admin/admin_edit_member.php";