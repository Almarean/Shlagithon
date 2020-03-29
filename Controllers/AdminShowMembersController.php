<?php

namespace App\Controllers;

use App\Services\MemberManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
} else if (isset($_SESSION["member"]) && unserialize($_SESSION["member"])->getType() !== "ADMIN") {
    header("Location: logout");
}

$members = MemberManager::findAllByDateCreation();
if (isset($_GET["deleteLogin"])) {
    MemberManager::deleteOneById($_GET["deleteLogin"]);
    header("Location: members-editor");
}
if (isset($_GET["editId"])) {
    header("Location: member-editor?editId=" . $_GET["editId"]);
}

require __DIR__ . "/../Views/admin/admin_show_members.php";