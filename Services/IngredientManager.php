<?php

namespace App\Services;

use PDO;
use App\Interfaces\IManager;
use App\Models\Ingredient;
use App\Services\MyPDO;

/**
 * Class IngredientManager extends MyPDO implements IManager.
 */
class IngredientManager extends MyPDO implements IManager
{
/**
     * Insert a ingredient in database.
     *
     * @param Ustencil $object
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return boolean
     */
    public static function insert($object, ?PDO $connection = null, bool $closeConnection = true): bool
    {
        if (get_class($object) === "App\\Models\\Ingredient") {
            $connection = parent::openConnection($connection);
            if (self::exists($object->getLabel(), $connection, $closeConnection)) {
                parent::closeConnection($connection, $closeConnection);
                return false;
            }
            $stmt = $connection->prepare("INSERT INTO requirement(req_label, req_type) VALUES (:label, 'INGREDIENT');");
            $stmt->bindValue(":label", $object->getLabel(), PDO::PARAM_STR);
            parent::closeConnection($connection, $closeConnection);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Fetch all ingredients in database.
     *
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return array
     */
    public static function fetchAll(?PDO $connection = null, bool $closeConnection = true): array
    {
        $connection = parent::openConnection($connection);
        $stmt = $connection->query("SELECT * FROM requirement WHERE req_type = 'INGREDIENT';");
        parent::closeConnection($connection, $closeConnection);
        $results = $stmt->fetchAll();
        $objects = [];
        foreach($results as $result) {
            array_push($objects, new Ingredient($result["req_label"]));
        }
        return $objects;
    }

    /**
     * Fetch an ingredient.
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
        $stmt = $connection->prepare("SELECT * FROM requirement WHERE req_label = :label WHERE req_type = 'INGREDIENT';");
        $stmt->bindValue(":label", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        parent::closeConnection($connection, $closeConnection);
        $result = $stmt->fetch();
        if ($result) {
            return new Ingredient($result["req_label"]);
        } else {
            return null;
        }
    }

    /**
     * Fetch the ID of the ingredient.
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
        $stmt = $connection->prepare("SELECT req_id FROM requirement WHERE req_name = :name AND req_type = 'INGREDIENT';");
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
     * Verify if the ingredient exists.
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