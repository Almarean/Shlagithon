<?php

namespace App\Controllers;

use App\Services\TicketManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
}

$member = unserialize($_SESSION["member"]);
if (isset($_GET["trigger-resolved"]) && isset($_GET["ticket-id"])) {
    TicketManager::updateIsResolved($_GET["ticket-id"], $_GET["trigger-resolved"]);
    header("Location: show-tickets");
}
$tickets = TicketManager::findAllByMemberId($member->getId());

require __DIR__ . "/../Views/member/show_tickets.php";