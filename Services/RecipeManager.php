<?php

namespace App\Services;

use PDO;
use App\Interfaces\IManager;
use App\Models\Recipe;
use App\Services\MyPDO;

/**
 * Class RecipeManager extends MyPDO implements Imanager;
 */
class RecipeManager extends MyPDO implements IManager
{
/**
     * Insert a recipe in database. TODO
     *
     * @param Recipe $object
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return boolean
     */
    public static function insert($object, ?PDO $connection = null, bool $closeConnection = true): bool
    {
        if (get_class($object) === "App\\Models\\Recipe") {
            $connection = parent::openConnection($connection);
            if (self::exists($object->getName(), $connection, $closeConnection)) {
                parent::closeConnection($connection, $closeConnection);
                return false;
            }
            $stmt = $connection->prepare("INSERT INTO recipe(rec_name, rec_description, rec_image, rec_difficulty, rec_time, rec_nb_persons, rec_advice, rec_fk_member_id) VALUES (:name, :description, :image, :difficulty, :time, :nbPersons, :advice, :memberId);");
            $stmt->bindValue(":name", $object->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":description", $object->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(":image", $object->getImage(), PDO::PARAM_STR);
            $stmt->bindValue(":difficulty", $object->getDifficulty(), PDO::PARAM_INT);
            $stmt->bindValue(":time", $object->getTime(), PDO::PARAM_INT);
            $stmt->bindValue(":nbPersons", $object->getNbPersons(), PDO::PARAM_INT);
            $stmt->bindValue(":advice", $object->getAdvice(), PDO::PARAM_STR);
            $stmt->bindValue(":memberId", $object->getMember()->getId(), PDO::PARAM_INT);
            parent::closeConnection($connection, $closeConnection);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Fetch all recipes in database.
     *
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return array
     */
    public static function fetchAll(?PDO $connection = null, bool $closeConnection = true): array
    {
        $connection = parent::openConnection($connection);
        $stmt = $connection->query("SELECT * FROM recipe;");
        parent::closeConnection($connection, $closeConnection);
        $results = $stmt->fetchAll();
        $objects = [];
        foreach($results as $result) {
            array_push($objects, new Recipe($result["rec_label"]));
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
        $stmt = $connection->prepare("SELECT * FROM recipe WHERE rec_label = :label;");
        $stmt->bindValue(":label", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        parent::closeConnection($connection, $closeConnection);
        $result = $stmt->fetch();
        if ($result) {
            return new Recipe($result["rec_name"], $result["rec_description"], $result["rec_image"], $result["difficulty"], $result["rec_time"], $result["rec_nb_persons"], $result["rec_advice"], $result["rec_fk_member_id"]);
        } else {
            return null;
        }
    }

    /**
     * Fetch the ID of the recipe.
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
        $stmt = $connection->prepare("SELECT rec_id FROM recipe WHERE rec_name = :name;");
        $stmt->bindValue(":name", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        parent::closeConnection($connection, $closeConnection);
        $result = $stmt->fetch();
        if ($result) {
            return $result["rec_id"];
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