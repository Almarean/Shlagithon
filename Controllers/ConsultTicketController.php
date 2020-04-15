<?php

namespace App\Controllers;

use App\Models\TicketAnswer;
use App\Services\TicketAnswerManager;
use App\Services\TicketManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
}

$member = unserialize($_SESSION["member"]);

if (isset($_GET["ticket-id"])) {
    $ticket = TicketManager::findOneById($_GET["ticket-id"]);
    $ticketAnswers = TicketAnswerManager::findAll();
}

if (count($_POST) > 0) {
    if (isset($_POST["text"])) {
        $answer = new TicketAnswer(0, $_POST["text"], TicketManager::findOneById($_POST["apply"]), date("Y-m-d H:i:s"), $member);
        TicketAnswerManager::insert($answer);
        header("Location: consult-ticket?ticket-id=" . $_POST["apply"]);
    }
}

require __DIR__ . "/../Views/member/consult_ticket.php";