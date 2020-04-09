<?php

namespace App\Controllers;

use App\Models\Member;
use App\Services\MemberManager;

if (count($_POST) > 0) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $result = MemberManager::findOneBy($email, false);
    $errors = [];
    if (!$result || $result["m_is_deleted"] === true) {
        $errors[] = "Aucun compte n'existe avec cet e-mail.";
    } else if (!$result["m_is_confirmed"]) {
        $errors[] = "Veuillez confirmer votre e-mail avant de vous connecter.";
    } else if (password_verify($password, $result["m_password"])) {
        $member = new Member($result["m_id"], $result["m_name"], $result["m_firstname"], $result["m_email"], $result["m_password"], $result["m_type"], $result["m_is_confirmed"]);
        $member->setLastConnectionDate(date("Y-m-d H:i:s"));
        MemberManager::updateLastConnectionDate($member->getId());
        $_SESSION["member"] = serialize($member);
        if ($member->getType() === "ADMIN") {
            header("Location: /Shlagithon/index.php/members");
        } else {
            header("Location: /Shlagithon/index.php/profile");
        }
    } else {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }
}

require __DIR__ . "/../Views/login.php";