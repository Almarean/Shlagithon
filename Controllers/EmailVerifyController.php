<?php

namespace App\Controllers;

use App\Services\MemberManager;

if (MemberManager::findOneBy($_GET["email"], false)) {
    MemberManager::updateMemberConfirmation($_GET["email"], true);
    echo $twig->render("login.twig", [
        "email" => $_GET["email"],
        "confirmed" => 1
    ]);
    // header("Location: login?confirmed=1&email=" . $_GET["email"]);
} else {
    echo $twig->render("login.twig", [
        "confirmed" => 0
    ]);
    // header("Location: login?confirmed=0");
}