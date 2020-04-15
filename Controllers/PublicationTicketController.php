<?php

namespace App\Controllers;

use App\Models\Ticket;
use App\Services\RecipeManager;
use App\Services\TicketManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
}
$member = unserialize($_SESSION["member"]);

if (count($_POST) > 0) {
    if (isset($_POST["text"]) && isset($_POST["subject"])) {
        $ticket = new Ticket(0, $_POST["subject"], $_POST["text"], $member, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"),0);
        TicketManager::insert($ticket);
        header("Location: show_ticket");
    }
}


require __DIR__ . "/../Views/member/publication_ticket.php";