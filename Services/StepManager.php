<?php

namespace App\Models;

use PDO;
use App\Interfaces\IManager;
use App\Models\Step;
use App\Services\MyPDO;
use App\Services\RecipeManager;

/**
 * Class AllergenManager extends MyPDO implements IManager.
 */
class StepManager extends MyPDO implements IManager
{
    /**
     * Insert a step in database.
     *
     * @param Step $object
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return boolean
     */
    public static function insert($object, ?PDO $connection = null, bool $closeConnection = true): bool
    {
        if (get_class($object) === "App\\Models\\Step") {
            $connection = parent::openConnection($connection);
            if (self::exists($object->getLabel(), $connection, $closeConnection)) {
                parent::closeConnection($connection, $closeConnection);
                return false;
            }
            $stmt = $connection->prepare("INSERT INTO step(s_description, s_order, s_fk_recipe) VALUES (:description, :order, :recipe);");
            $stmt->bindValue(":description", $object->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(":order", $object->getOrder(), PDO::PARAM_INT);
            $stmt->bindValue(":recipe", $object->getRecipe()->getId(), PDO::PARAM_INT);
            parent::closeConnection($connection, $closeConnection);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Fetch all steps in database.
     *
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return array
     */
    public static function fetchAll(?PDO $connection = null, bool $closeConnection = true): array
    {
        $connection = parent::openConnection($connection);
        $stmt = $connection->query("SELECT * FROM step;");
        parent::closeConnection($connection, $closeConnection);
        $results = $stmt->fetchAll();
        $objects = [];
        foreach($results as $result) {
            //$recipe = RecipeManager::
            //array_push($objects, new Step($result["s_description"], $result["s_order"]));
        }
        return $objects;
    }

    /**
     * Fetch a step.
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
        $stmt = $connection->prepare("SELECT * FROM step WHERE ");
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
        if (self::fetchOneBy($identifier, $connection, $closeConnection)) {
            return true;
        } else {
            return false;
        }
    }
}