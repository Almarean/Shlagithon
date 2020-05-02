<?php

namespace App\Services;

use PDO;
use App\Interfaces\IManager;
use App\Models\Recipe;
use App\Models\Step;
use App\Services\PDOManager;
use App\Services\RecipeManager;

/**
 * Class AllergenManager implements IManager.
 */
class StepManager implements IManager
{
    /**
     * Insert a step in database.
     *
     * @param Step $object
     *
     * @return boolean
     */
    public static function insert($object): bool
    {
        if (get_class($object) === "App\\Models\\Step") {
            if (self::exists($object->getDescription())) {
                return false;
            }
            $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO step(s_description, s_order, s_fk_recipe_id) VALUES (:description, :order, :recipeId);");
            $stmt->bindValue(":description", $object->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(":order", $object->getOrder(), PDO::PARAM_INT);
            $stmt->bindValue(":recipeId", RecipeManager::findIdBy($object->getRecipe()->getName()), PDO::PARAM_INT);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Fetch all steps in database.
     *
     * @return array
     */
    public static function findAll(): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->query("SELECT * FROM step;");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            array_push($objects, new Step($result["s_description"], $result["s_order"], RecipeManager::findOneById($result["s_fk_recipe_id"])));
        }
        return $objects;
    }

    /**
     * Fetch all step by recipe.
     *
     * @param Recipe $recipe
     *
     * @return array
     */
    public static function findAllByRecipe(Recipe $recipe): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM step WHERE s_fk_recipe_id = :recipeId ORDER BY s_order ASC;");
        $stmt->bindValue(":recipeId", RecipeManager::findIdBy($recipe->getName()), PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            array_push($objects, new Step($result["s_description"], $result["s_order"], RecipeManager::findOneBy($recipe->getName())));
        }
        return $objects;
    }

    /**
     * Fetch a step.
     *
     * @param void $identifier
     * @param bool $convertIntoObject
     *
     * @return Step|null|array
     */
    public static function findOneBy($identifier, bool $convertIntoObject = true)
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM step WHERE s_id = :id;");
        $stmt->bindValue(":id", $identifier, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$convertIntoObject) {
            return $result;
        }
        return $result ? new Step($result["s_description"], $result["s_order"], RecipeManager::findOneBy($result["s_fk_recipe_id"])) : null;
    }

    /**
     * Fetch the ID of the step.
     *
     * @param void $identifier
     *
     * @return integer|null
     */
    public static function findIdBy($identifier): ?int
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT s_id FROM step WHERE s_description = :description;");
        $stmt->bindValue(":description", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result["s_id"] : null;
    }

    /**
     * Verify if the step exists.
     *
     * @param void $identifier
     *
     * @return boolean
     */
    public static function exists($identifier): bool
    {
        return self::findOneBy($identifier) ? true : false;
    }
}