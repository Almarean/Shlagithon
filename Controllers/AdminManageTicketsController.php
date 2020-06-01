<?php

namespace App\Controllers;

use App\Services\TicketManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
} else if (isset($_SESSION["member"]) && unserialize($_SESSION["member"])->getType() !== "ADMIN") {
    header("Location: logout");
}
$member = unserialize($_SESSION["member"]);
$tickets = TicketManager::findAllWithFilter();

if (isset($_POST["filter"])) {
    if ($_POST["select-filter"] === "open") {
        $tickets = TicketManager::findAllWithFilter();
    } else {
        $tickets = TicketManager::findAllWithFilter(true);
    }
}

require __DIR__ . "/../Views/admin/admin_manage_tickets.php";