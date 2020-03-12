<?php

namespace App\Services;

use PDO;
use App\Interfaces\IManager;
use App\Models\Allergen;
use App\Services\MyPDO;

/**
 * Class AllergenManager extends MyPDO implements IManager.
 */
class AllergenManager extends MyPDO implements IManager
{
    /**
     * Insert an allergen in database.
     *
     * @param Allergen $object
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return boolean
     */
    public static function insert($object, ?PDO $connection = null, bool $closeConnection = true): bool
    {
        if (get_class($object) === "App\\Models\\Allergen") {
            $connection = parent::openConnection($connection);
            if (self::exists($object->getLabel(), $connection, $closeConnection)) {
                parent::closeConnection($connection, $closeConnection);
                return false;
            }
            $stmt = $connection->prepare("INSERT INTO allergen(a_label) VALUES (:label);");
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
        $stmt = $connection->query("SELECT * FROM allergen;");
        parent::closeConnection($connection, $closeConnection);
        $results = $stmt->fetchAll();
        $objects = [];
        foreach($results as $result) {
            array_push($objects, new Allergen($result["a_label"]));
        }
        return $objects;
    }

    /**
     * Fetch an allergen.
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
        $stmt = $connection->prepare("SELECT * FROM allergen WHERE a_label = :label;");
        $stmt->bindValue(":label", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        parent::closeConnection($connection, $closeConnection);
        $result = $stmt->fetch();
        if ($result) {
            return new Allergen($result["a_label"]);
        } else {
            return null;
        }
    }

    /**
     * Fetch the ID of the allergen.
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
        $stmt = $connection->prepare("SELECT a_id FROM allergen WHERE a_name = :name;");
        $stmt->bindValue(":name", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        parent::closeConnection($connection, $closeConnection);
        $result = $stmt->fetch();
        if ($result) {
            return $result["a_id"];
        } else {
            return null;
        }
    }

    /**
     * Verify if the allergen exists.
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