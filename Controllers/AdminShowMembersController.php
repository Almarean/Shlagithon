<?php

namespace App\Controllers;

use App\Services\MemberManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
} else if (isset($_SESSION["member"]) && unserialize($_SESSION["member"])->getType() !== "ADMIN") {
    header("Location: logout");
}

$members = MemberManager::findAllByDateCreation();
if (isset($_GET["delete-login"])) {
    MemberManager::changeDeletionOneById($_GET["delete-login"]);
    header("Location: members-editor");
}
if (isset($_GET["edit-id"])) {
    header("Location: member-editor?edit-id=" . $_GET["edit-id"]);
}

require __DIR__ . "/../Views/admin/admin_show_members.php";