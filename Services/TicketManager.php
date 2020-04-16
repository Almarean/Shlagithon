<?php

namespace App\Services;

use PDO;
use App\Models\Ticket;

/**
 * Class TicketManager.
 */
class TicketManager
{
    /**
     * Insert a Ticket in database.
     *
     * @param Ticket $object
     *
     * @return boolean
     */
    public static function insert($object): bool
    {
        if (get_class($object) == "App\\Models\\Ticket") {
            $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO ticket(ti_subject, ti_text, ti_writing_date, ti_last_update, ti_fk_member_id) VALUES (:subject, :text, :writing_date, :last_update, :memberId);");
            $stmt->bindValue(":subject", $object->getSubject(), PDO::PARAM_STR);
            $stmt->bindValue(":text", $object->getText(), PDO::PARAM_STR);
            $stmt->bindValue(":writing_date", $object->getWritingDate(), PDO::PARAM_STR);
            $stmt->bindValue(":last_update", $object->getLastUpdateDate(), PDO::PARAM_STR);
            $stmt->bindValue(":memberId", $object->getAuthor()->getId(), PDO::PARAM_INT);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Fetch all tickets in database.
     *
     * @return array
     */
    public static function findAll(): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->query("SELECT * FROM ticket;");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            $author = MemberManager::findOneByID($result["ti_fk_member_id"]);
            $ticket = new Ticket($result["ti_id"], $result["ti_subject"], $result["ti_text"], $author, $result["ti_writing_date"], $result["ti_last_update"], $result["ti_is_resolved"]);
            array_push($objects, $ticket);
        }
        return $objects;
    }

    /**
     * Fetch all tickets by memberId in database.
     *
     * @return array
     */
    public static function findAllByMemberId(int $memberId): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM ticket where ti_fk_member_id = :memberId;");
        $stmt->bindValue(":memberId", $memberId, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            $author = MemberManager::findOneByID($memberId);
            $ticket = new Ticket($result["ti_id"], $result["ti_subject"], $result["ti_text"], $author, $result["ti_writing_date"], $result["ti_last_update"], $result["ti_is_resolved"]);
            array_push($objects, $ticket);
        }
        return $objects;
    }

    /**
     * Fetch a ticket by an ID.
     *
     * @param int $id
     *
     * @return Ticket|null
     */
    public static function findOneById(int $id): ?Ticket
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM ticket WHERE ti_id = :ticketId;");
        $stmt->bindValue(":ticketId", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? new Ticket($result["ti_id"], $result["ti_subject"], $result["ti_text"], MemberManager::findOneByID($result["ti_fk_member_id"]), $result["ti_writing_date"], $result["ti_last_update"], $result["ti_is_resolved"]) : null;
    }

    /**
     * Update a Ticket resolution state by his ID.
     *
     * @param int $identifier
     * @param bool $isResolved
     *
     * @return bool
     */
    public static function updateIsResolved(int $identifier, bool $isResolved): bool
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("UPDATE ticket SET ti_is_resolved = :isResolved WHERE ti_id = :id;");
        $stmt->bindValue(":id", $identifier, PDO::PARAM_INT);
        $stmt->bindValue(":isResolved", $isResolved, PDO::PARAM_BOOL);
        return $stmt->execute();
    }

    /**
     * Fetch all ticket with a filter
     *
     * @param bool $isResolved
     *
     * @return array
     */
    public static function findAllWithFilter(bool $isResolved = false): ?array
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM ticket where ti_is_resolved = :isResolved ORDER BY ti_writing_date ASC;");
        $stmt->bindValue(":isResolved", $isResolved, PDO::PARAM_BOOL);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            $author = MemberManager::findOneByID($result["ti_fk_member_id"]);
            $ticket = new Ticket($result["ti_id"], $result["ti_subject"], $result["ti_text"], $author, $result["ti_writing_date"], $result["ti_last_update"], $result["ti_is_resolved"]);
            array_push($objects, $ticket);
        }
        return $objects;
    }
}