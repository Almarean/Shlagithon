<?php

namespace App\Controllers;

use App\Services\MemberManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
} else if (isset($_SESSION["member"]) && unserialize($_SESSION["member"])->getType() !== "ADMIN") {
    header("Location: logout");
}

$members = MemberManager::findAllByDateCreation();
if (isset($_GET["delete"])) {
    MemberManager::changeDeletionOneById($_GET["delete"]);
    header("Location: members");
}
if (isset($_GET["edit"])) {
    header("Location: member?edit=" . $_GET["edit"]);
}

require __DIR__ . "/../Views/admin/admin_show_members.php";