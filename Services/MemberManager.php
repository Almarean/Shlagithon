<?php

namespace App\Services;

use PDO;
use App\Interfaces\IManager;
use App\Models\Member;
use App\Services\MyPDO;

/**
 * Class MemberManager extends MyPDO implements IManager.
 */
class MemberManager extends MyPDO implements IManager
{
    /**
     * Insert an member in database.
     *
     * @param Member $object
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return boolean
     */
    public static function insert($object, ?PDO $connection = null, bool $closeConnection = true): bool
    {
        if (get_class($object) === "App\\Models\\Member") {
            $connection = parent::openConnection($connection);
            if (self::exists($object->getEmail(), $connection, $closeConnection)) {
                parent::closeConnection($connection, $closeConnection);
                return false;
            }
            $stmt = $connection->prepare("INSERT INTO member(m_name, m_firstname, m_email, m_password, m_type, m_is_confirmed, m_creation_date, m_last_connection_date) VALUES (:name, :firstname, :email, :password, 'MEMBER', 0, :creationDate, :lastConnectionDate);");
            $stmt->bindValue(":name", $object->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":firstname", $object->getFirstname(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $object->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":password", $object->getPassword(), PDO::PARAM_STR);
            $stmt->bindValue(":creationDate", $object->getCreationDate(), PDO::PARAM_STR);
            $stmt->bindValue(":lastConnectionDate", $object->getLastConnectionDate(), PDO::PARAM_STR);
            parent::closeConnection($connection, $closeConnection);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Fetch all members in database.
     *
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return array
     */
    public static function fetchAll(?PDO $connection = null, bool $closeConnection = true): array
    {
        $connection = parent::openConnection($connection);
        $stmt = $connection->query("SELECT * FROM member;");
        parent::closeConnection($connection, $closeConnection);
        $results = $stmt->fetchAll();
        $objects = [];
        foreach($results as $result) {
            $member = new Member($result["m_name"], $result["m_firstname"], $result["m_email"], $result["m_password"], $result["m_type"]);
            $member->setCreationDate($result["m_creation_date"]);
            $member->setLastConnectionDate($result["m_last_connection_date"]);
            $member->setIsConfirmed($result["m_is_confirmed"]);
            // TODO : set the favorite recipes and the written recipes with setters
            array_push($objects, $member);
        }
        return $objects;
    }

    public static function getAll(?PDO $connection = null, bool $closeConnection = true): array
    {
        $connection = parent::openConnection($connection);
        $stmt = $connection->query("SELECT * FROM member;");
        parent::closeConnection($connection, $closeConnection);
        $results = [];
        while ($result = $stmt->fetchObject("Member")) {
            $results[] = $result;
        }
        return $results;
    }

    /**
     * Fetch a member.
     *
     * @param string $identifier
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return Allergen|null
     */
    public static function fetchOneBy(string $identifier, ?PDO $connection = null, bool $closeConnection = true): ?Allergen
    {
        $connection = parent::openConnection($connection);
        $stmt = $connection->prepare("SELECT * FROM member WHERE m_name = :name;");
        $stmt->bindValue(":name", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        parent::closeConnection($connection, $closeConnection);
        $result = $stmt->fetch();
        if ($result) {
            $member = new Member($result["m_name"], $result["m_firstname"], $result["m_email"], $result["m_password"], $result["m_type"]);
            $member->setCreationDate($result["m_creation_date"]);
            $member->setLastConnectionDate($result["m_last_connection_date"]);
            $member->setIsConfirmed($result["m_is_confirmed"]);
            // TODO : set the favorite recipes and the written recipes
            return $member;
        } else {
            return null;
        }
    }

    /**
     * Fetch the ID of the member.
     *
     * @param string $identifier
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return integer|null
     */
    public static function fetchIdBy(string $identifier, ?PDO $connection = null, bool $closeConnection = true): ?int
    {
        $connection = parent::openConnection($connection);
        $stmt = $connection->prepare("SELECT m_id FROM member WHERE m_name = :name;");
        $stmt->bindValue(":name", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        parent::closeConnection($connection, $closeConnection);
        $result = $stmt->fetch();
        if ($result) {
            return $result["m_id"];
        } else {
            return null;
        }
    }

    /**
     * Verify if the member exists.
     *
     * @param string $identifier
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return boolean
     */
    public static function exists(string $identifier, ?PDO $connection = null, bool $closeConnection = true): bool
    {
        if (self::fetchOneBy($identifier, $connection, $closeConnection)) {
            return true;
        } else {
            return false;
        }
    }
}