<?php

namespace App\Controllers;

use App\Services\MemberManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
} else if (isset($_SESSION["member"]) && unserialize($_SESSION["member"])->getType() !== "ADMIN") {
    header("Location: logout");
}
$member = unserialize($_SESSION["member"]);

if (isset($_GET["edit-id"])) {
    $memberToModify = MemberManager::findOneByID($_GET["edit-id"]);
}

if (isset($_POST["validate"])) {
    if (isset($_POST["name"]) && isset($_POST["firstname"]) && $_POST["email"] && $_POST["typeRadio"]) {
        MemberManager::updateMember($_POST["validate"], $_POST["name"], $_POST["firstname"], $_POST["email"], $_POST["typeRadio"]);
        header("Location: member-editor?editId=" . $_POST["validate"]);
    }
}

if (isset($_POST["return"])) {
    header("Location: members-editor");
}

require __DIR__ . "/../Views/edit_member.php";