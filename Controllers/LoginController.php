<?php

namespace App\Controllers;

require_once __DIR__ . "/../Interfaces/IManager.php";
require_once __DIR__ . "/../Services/RecipeManager.php";
require_once __DIR__ . "/../Models/Member.php";
require_once __DIR__ . "/../Services/PDOManager.php";
require_once __DIR__ . "/../Services/MemberManager.php";

use App\Models\Member;
use App\Services\MemberManager;

if (count($_POST) > 0) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $result = MemberManager::findOneBy($email, false);
    $errors = [];
    if (!$result) {
        $errors[] = "Aucun compte n'existe avec cet e-mail.";
    } else if (password_verify($password, $result["m_password"])) {
        $member = new Member(0, $result["m_name"], $result["m_firstname"], $result["m_email"], $result["m_password"], $result["m_type"]);
        session_start();
        $_SESSION["member"] = serialize($member);
        if ($member->getType() === "ADMIN") {
            header("Location: /Shlagithon/index.php/members-editor");
            exit();
        } else {
            header("Location: /Shlagithon/index.php/member-profile");
        }
    } else {
        $errors[] = "Les mots de passe ne correspondent pas.";
    }
}

require __DIR__ . "/../Views/login.php";