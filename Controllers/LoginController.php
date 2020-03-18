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
    if (password_verify($password, $result["m_password"])) {
        $member = new Member(0, $result["m_name"], $result["m_firstname"], $result["m_email"], $result["m_password"], $result["m_type"]);
        var_dump($member);
        session_start();
        $_SESSION["member"] = serialize($member);
    }
}

require __DIR__ . "/../Views/login.php";