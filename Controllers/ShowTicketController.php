<?php

namespace App\Controllers;

use App\Models\Ticket;
use App\Services\TicketManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
}

$member = unserialize($_SESSION["member"]);
if(isset($_GET["triggerResolved"])){
    TicketManager::updateIsResolved($member->getId(),$_GET["triggerResolved"]);
    header("Location: show_ticket");
}
$tickets = TicketManager::findAllByMemberId($member->getId());


require __DIR__ . "/../Views/member/show_ticket.php";