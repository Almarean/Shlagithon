<?php

namespace App\Controllers;

use App\Services\MemberManager;

if (MemberManager::findOneBy($_GET["email"], false)) {
    MemberManager::updateMemberConfirmation($_GET["email"], true);
    header("Location: login?confirmed=1&email=" . $_GET["email"]);
} else {
    header("Location: login?confirmed=0");
}