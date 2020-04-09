<?php

namespace App\Controllers;

use App\Services\MemberManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
}
$member = unserialize($_SESSION["member"]);
$memberToModify = $member;

$memberId = MemberManager::findIdBy($memberToModify->getEmail());

if (isset($_POST["name"]) && isset($_POST["firstname"]) && isset($_POST["email"])) {
    $errors = [];
    $email = $_POST["email"];
    $password = trim($_POST["password"]);

    if (MemberManager::exists($email) && $email !== $member->getEmail()) {
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
        $memberToModify->setName($_POST["name"]);
        $memberToModify->setFirstname($_POST["firstname"]);
        $memberToModify->setEmail($email);
        $memberToModify->setPassword($password);
        if (strlen($password) > 0) {
            $memberToModify->setPassword($password);
            MemberManager::updateMember($memberId, $memberToModify->getName(), $memberToModify->getFirstname(), $memberToModify->getEmail(), "MEMBER", $memberToModify->getPassword());
        } else {
            MemberManager::updateMember($memberId, $memberToModify->getName(), $memberToModify->getFirstname(), $memberToModify->getEmail(), "MEMBER");
        }
        $_SESSION["member"] = serialize($memberToModify);
        header("Location: profile?success=1");
    }
}

require __DIR__ . "/../Views/member/edit_member.php";