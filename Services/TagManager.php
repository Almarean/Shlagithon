<?php

namespace App\Services;

use PDO;
use App\Interfaces\IManager;
use App\Models\Tag;
use App\Services\MyPDO;

/**
 * Class TagManager extends MyPDO implements IManager.
 */
class TagManager extends MyPDO implements IManager
{
    /**
     * Insert a tag in database.
     *
     * @param Tag $object
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return boolean
     */
    public static function insert($object, ?PDO $connection = null, bool $closeConnection = true): bool
    {
        if (get_class($object) === "App\\Models\\Tag") {
            $connection = parent::openConnection($connection);
            if (self::exists($object->getLabel(), $connection, $closeConnection)) {
                parent::closeConnection($connection, $closeConnection);
                return false;
            }
            $stmt = $connection->prepare("INSERT INTO tag(t_label) VALUES (:label);");
            $stmt->bindValue(":label", $object->getLabel(), PDO::PARAM_STR);
            parent::closeConnection($connection, $closeConnection);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Fetch all tags in database.
     *
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return array
     */
    public static function fetchAll(?PDO $connection = null, bool $closeConnection = true): array
    {
        $connection = parent::openConnection($connection);
        $stmt = $connection->query("SELECT * FROM tag;");
        parent::closeConnection($connection, $closeConnection);
        $results = $stmt->fetchAll();
        $objects = [];
        foreach($results as $result) {
            array_push($objects, new Tag($result["t_label"]));
        }
        return $objects;
    }

    /**
     * Fetch a tag.
     *
     * @param string $identifier
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return Tag|null
     */
    public static function fetchOneBy(string $identifier, ?PDO $connection = null, bool $closeConnection = true): ?Tag
    {
        $connection = parent::openConnection($connection);
        $stmt = $connection->prepare("SELECT * FROM tag WHERE t_label = :label;");
        $stmt->bindValue(":label", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        parent::closeConnection($connection, $closeConnection);
        $result = $stmt->fetch();
        if ($result) {
            return new Tag($result["t_label"]);
        } else {
            return null;
        }
    }

    /**
     * Fetch the ID of the tag.
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
        $stmt = $connection->prepare("SELECT t_id FROM tag WHERE t_name = :name;");
        $stmt->bindValue(":name", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        parent::closeConnection($connection, $closeConnection);
        $result = $stmt->fetch();
        if ($result) {
            return $result["t_id"];
        } else {
            return null;
        }
    }

    /**
     * Verify if the tag exists.
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