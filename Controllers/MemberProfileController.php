<?php

namespace App\Controllers;

if (isset($_SESSION["member"])) {
    $member = unserialize($_SESSION["member"]);
    if ($member->getIsConfirmed()) {
        var_dump($member);
        exit();
    } else {
        header("Location: logout");
    }
} else {
    header("Location: logout");
}

require __DIR__ . "/../Views/member/member_profile.php";