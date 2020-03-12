<?php

namespace App\Services;

use PDO;
use App\Interfaces\IManager;
use App\Models\Ustencil;
use App\Services\MyPDO;

/**
 * Class UstencilManager extends MyPDO implements IManager.
 */
class UstencilManager extends MyPDO implements IManager
{
    /**
     * Insert a ustencil in database.
     *
     * @param Ustencil $object
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return boolean
     */
    public static function insert($object, ?PDO $connection = null, bool $closeConnection = true): bool
    {
        if (get_class($object) === "App\\Models\\Ustencil") {
            $connection = parent::openConnection($connection);
            if (self::exists($object->getLabel(), $connection, $closeConnection)) {
                parent::closeConnection($connection, $closeConnection);
                return false;
            }
            $stmt = $connection->prepare("INSERT INTO requirement(req_label, req_type) VALUES (:label, 'USTENCIL');");
            $stmt->bindValue(":label", $object->getLabel(), PDO::PARAM_STR);
            parent::closeConnection($connection, $closeConnection);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Fetch all ustencils in database.
     *
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return array
     */
    public static function fetchAll(?PDO $connection = null, bool $closeConnection = true): array
    {
        $connection = parent::openConnection($connection);
        $stmt = $connection->query("SELECT * FROM requirement WHERE req_type = 'USTENCIL';");
        parent::closeConnection($connection, $closeConnection);
        $results = $stmt->fetchAll();
        $objects = [];
        foreach($results as $result) {
            array_push($objects, new Ustencil($result["req_label"]));
        }
        return $objects;
    }

    /**
     * Fetch a ustencil.
     *
     * @param string $identifier
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return null|Ustencil
     */
    public static function fetchOneBy(string $identifier, ?PDO $connection = null, bool $closeConnection = true): ?Tag
    {
        $connection = parent::openConnection($connection);
        $stmt = $connection->prepare("SELECT * FROM requirement WHERE req_label = :label WHERE req_type = 'USTENCIL';");
        $stmt->bindValue(":label", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        parent::closeConnection($connection, $closeConnection);
        $result = $stmt->fetch();
        if ($result) {
            return new Ustencil($result["req_label"]);
        } else {
            return null;
        }
    }

    /**
     * Fetch the ID of the ustencil.
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
        $stmt = $connection->prepare("SELECT req_id FROM requirement WHERE req_name = :name AND req_type = 'USTENCIL';");
        $stmt->bindValue(":name", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        parent::closeConnection($connection, $closeConnection);
        $result = $stmt->fetch();
        if ($result) {
            return $result["req_id"];
        } else {
            return null;
        }
    }

    /**
     * Verify if the ustencil exists.
     *
     * @param string $identifier
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return boolean
     */
    public static function exists(string $identifier, ?PDO $connection = null, bool $closeConnection = true): bool
    {
        if (self::fetchOneByIdentifier($identifier, $connection, $closeConnection)) {
            return true;
        } else {
            return false;
        }
    }
}