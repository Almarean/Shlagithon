<?php

namespace App\Controllers;

use App\Services\MemberManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
}
$member = unserialize($_SESSION["member"]);
if (!$member->getIsConfirmed()) {
    header("Location: logout");
}

$memberId = MemberManager::findIdBy($member->getEmail());

if (isset($_POST["name"]) && isset($_POST["firstname"]) && isset($_POST["email"])) {
    $member->setName($_POST["name"]);
    $member->setFirstname($_POST["firstname"]);
    $member->setEmail($_POST["email"]);
    if (strlen(trim($_POST["password"])) > 0) {
        $member->setPassword(trim($_POST["password"]));
        MemberManager::updateMember($memberId, $member->getName(), $member->getFirstname(), $member->getEmail(), "MEMBER", $member->getPassword());
    } else {
        MemberManager::updateMember($memberId, $member->getName(), $member->getFirstname(), $member->getEmail(), "MEMBER");
    }
    $_SESSION["member"] = serialize($member);
    header("Location: profile?success=1");
}

require __DIR__ . "/../Views/admin/admin_edit_member.php";