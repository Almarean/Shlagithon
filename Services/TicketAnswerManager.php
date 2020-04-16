<?php

namespace App\Services;

use PDO;
use App\Models\Ticket;
use App\Models\TicketAnswer;
use App\Services\TicketManager;

/**
 * Class TicketManager.
 */
class TicketAnswerManager
{
    /**
     * Insert a TicketAnswer in database.
     *
     * @param TicketAnswer $object
     *
     * @return boolean
     */
    public static function insert($object): bool
    {
        if (get_class($object) == "App\\Models\\TicketAnswer") {
            $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO ticket_answer(ti_a_text, ti_a_writing_date, ti_a_fk_ticket_id, ti_a_fk_member_id) VALUES (:text, :writing_date, :ticketId, :memberId);");
            $stmt->bindValue(":text", $object->getText(), PDO::PARAM_STR);
            $stmt->bindValue(":writing_date", $object->getWritingDate(), PDO::PARAM_STR);
            $stmt->bindValue(":ticketId", $object->getTicket()->getId(), PDO::PARAM_INT);
            $stmt->bindValue(":memberId", $object->getAuthor()->getId(), PDO::PARAM_INT);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Fetch all ticketAnswers in database.
     *
     * @return array
     */
    public static function findAll(): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->query("SELECT * FROM ticket_answer;");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            $ticket = TicketManager::findOneByID($result["ti_a_fk_ticket_id"]);
            $author = MemberManager::findOneByID($result["ti_a_fk_member_id"]);
            $ticket = new TicketAnswer($result["ti_a_id"], $result["ti_a_text"], $ticket, $result["ti_a_writing_date"], $author);
            array_push($objects, $ticket);
        }
        return $objects;
    }

    /**
     * Fetch all ticketAnswers in database by ticket id.
     *
     * @return array
     */
    public static function findAllByOneTicketId(int $id): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM ticket_answer WHERE ti_a_fk_ticket_id = :ticketId;");
        $stmt->bindValue(":ticketId", $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            $ticket = TicketManager::findOneByID($result["ti_a_fk_ticket_id"]);
            $author = MemberManager::findOneByID($result["ti_a_fk_member_id"]);
            $ticket = new TicketAnswer($result["ti_a_id"], $result["ti_a_text"], $ticket, $result["ti_a_writing_date"], $author);
            array_push($objects, $ticket);
        }
        return $objects;
    }

    /**
     * Fetch a ticketAnswer by an ID.
     *
     * @param int $id
     *
     * @return Ticket|null
     */
    public static function findOneById(int $id): ?TicketAnswer
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM ticket_answer WHERE ti_a_id = :ticketId;");
        $stmt->bindValue(":ticketId", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? new TicketAnswer($result["ti_a_id"], $result["ti_a_text"], TicketManager::findOneByID($result["ti_a_fk_member_id"]), $result["ti_a_writing_date"], MemberManager::findOneByID($result["ti_a_fk_member_id"])) : null;
    }
}