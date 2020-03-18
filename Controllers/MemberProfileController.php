<?php

namespace App\Controllers;

session_start();
var_dump(unserialize($_SESSION["member"]));
exit();
if (!isset($_SESSION["member"])) {
    header("Location: logout");
}

require __DIR__ . "/../Views/member/member_profile.php";