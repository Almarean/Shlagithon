<?php

namespace App\Controllers;
session_start();

use App\Models\Member;
use App\Services\MemberManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
} else if (isset($_SESSION["member"]) && unserialize($_SESSION["member"])->getType() !== "ADMIN") {
    header("Location: logout");
}

if (isset($_GET['editId'])) {
    $member = MemberManager::findOneByID($_GET["editId"]);
}

if (isset($_POST["validate"])) {
    if (isset($_POST["name"]) && isset($_POST["firstname"]) && $_POST["email"] && $_POST["typeRadio"]) {
        MemberManager::updateMember($_POST["validate"], $_POST["name"], $_POST["firstname"], $_POST["email"], $_POST["typeRadio"]);
        header("Location: member-editor?editId=". $_POST["validate"]);
    }
}

if (isset($_POST["return"])) {
    header("Location: members-editor");
}

require __DIR__ . "/../Views/admin/admin_edit_member.php";