<?php

namespace App\Services;

use PDO;
use App\Interfaces\IRequirementManager;
use App\Models\Recipe;
use App\Models\Tag;

/**
 * Class TagManager implements IRequirementManager.
 */
class TagManager implements IRequirementManager
{
    /**
     * Insert a tag and a recipe in database.
     *
     * @param Tag $object
     * @param Recipe $recipe
     *
     * @return boolean
     */
    public static function insert($object, Recipe $recipe): bool
    {
        if (get_class($object) === "App\\Models\\Tag") {
            if (self::exists($object->getLabel())) {
                return false;
            }
            $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO tag(t_label) VALUES (:label);");
            $stmt->bindValue(":label", $object->getLabel(), PDO::PARAM_STR);
            $stmtT = $stmt->execute();
            $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO recipe_tag(rt_fk_recipe_id, rt_fk_tag_id) VALUES (:recipeId, :tagId);");
            $stmt->bindValue(":recipeId", RecipeManager::findIdBy($recipe->getName()), PDO::PARAM_INT);
            $stmt->bindValue(":tagId", self::findIdBy($object->getLabel()), PDO::PARAM_INT);
            $stmtRt = $stmt->execute();
            return $stmtT && $stmtRt;
        } else {
            return false;
        }
    }

    /**
     * Insert a tag and in database.
     *
     * @param Tag $object
     *
     * @return boolean
     */
    public static function insertTag($object): bool
    {
        if (get_class($object) === "App\\Models\\Tag") {
            if (self::exists($object->getLabel())) {
                return false;
            }
            $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO tag(t_label) VALUES (:label);");
            $stmt->bindValue(":label", $object->getLabel(), PDO::PARAM_STR);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Fetch all tags in database.
     *
     * @return array
     */
    public static function findAll(): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->query("SELECT * FROM tag;");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            array_push($objects, new Tag($result["t_id"], $result["t_label"]));
        }
        return $objects;
    }

    /**
     * Fetch all tags by recipe.
     *
     * @param Recipe $recipe
     *
     * @return array
     */
    public static function findAllByRecipe(Recipe $recipe): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM tag INNER JOIN recipe_tag ON tag.t_id = recipe_tag.rt_fk_tag_id WHERE rt_fk_recipe_id = :recipeId;");
        $stmt->bindValue(":recipeId", RecipeManager::findIdBy($recipe->getName()));
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            array_push($objects, new Tag($result["t_id"], $result["t_label"]));
        }
        return $objects;
    }

    /**
     * Fetch a tag.
     *
     * @param void $identifier
     * @param bool $convertIntoObject
     *
     * @return Tag|null|array
     */
    public static function findOneBy($identifier, bool $convertIntoObject = true)
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM tag WHERE t_label = :label;");
        $stmt->bindValue(":label", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$convertIntoObject) {
            return $result;
        }
        return $result ? new Tag($result["t_id"], $result["t_label"]) : null;
    }

    /**
     * Fetch the ID of the tag.
     *
     * @param void $identifier
     *
     * @return integer|null
     */
    public static function findIdBy($identifier): ?int
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT t_id FROM tag WHERE t_label = :label;");
        $stmt->bindValue(":label", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result["t_id"] : null;
    }

    /**
     * Verify if the tag exists.
     *
     * @param void $identifier
     *
     * @return boolean
     */
    public static function exists($identifier): bool
    {
        return self::findOneBy($identifier) ? true : false;
    }

    /**
     * Remove a tag from database.
     *
     * @param int $identifier
     *
     * @return bool
     */
    public static function deleteOneById($identifier): bool
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("DELETE FROM tag WHERE t_id = :id;");
        $stmt->bindValue(":id", $identifier, PDO::PARAM_INT);
        return $stmt->execute();
    }
}