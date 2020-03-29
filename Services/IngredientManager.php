<?php

namespace App\Services;

use PDO;
use App\Interfaces\IManager;
use App\Models\Ingredient;
use App\Models\Recipe;

/**
 * Class IngredientManager implements IManager.
 */
class IngredientManager implements IManager
{
    /**
     * Insert a ingredient in database.
     *
     * @param Ingredient $object
     *
     * @return boolean
     */
    public static function insert($object): bool
    {
        if (get_class($object) === "App\\Models\\Ingredient") {
            if (self::exists($object->getLabel())) {
                return false;
            }
            $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO requirement(req_label, req_type) VALUES (:label, 'INGREDIENT');");
            $stmt->bindValue(":label", $object->getLabel(), PDO::PARAM_STR);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Fetch all ingredients in database.
     *
     * @return array
     */
    public static function findAll(): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->query("SELECT * FROM requirement WHERE req_type = 'INGREDIENT';");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            array_push($objects, new Ingredient($result["req_id"], $result["req_label"]));
        }
        return $objects;
    }

    /**
     * Fetch an ingredient.
     *
     * @param void $identifier
     * @param bool $convertIntoObject
     *
     * @return null|Ingredient|array
     */
    public static function findOneBy($identifier, bool $convertIntoObject = true)
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM requirement WHERE req_label = :label AND req_type = 'INGREDIENT';");
        $stmt->bindValue(":label", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$convertIntoObject) {
            return $result;
        }
        return $result ? new Ingredient($result["req_id"], $result["req_label"]) : null;
    }

    /**
     * Fetch the ID of the ingredient.
     *
     * @param void $identifier
     *
     * @return integer|null
     */
    public static function findIdBy($identifier): ?int
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT req_id FROM requirement WHERE req_label = :label AND req_type = 'INGREDIENT';");
        $stmt->bindValue(":label", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result["req_id"] : null;
    }

    /**
     * Verify if the ingredient exists.
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
     * Fetch all ingredients by recipe.
     *
     * @param Recipe $recipe
     *
     * @return array
     */
    public static function findAllByRecipe(Recipe $recipe): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM requirement INNER JOIN recipe_requirement ON requirement.req_id = recipe_requirement.rr_fk_requirement_id WHERE rr_fk_recipe_id = :recipeId AND req_type = 'INGREDIENT';");
        $stmt->bindValue(":recipeId", RecipeManager::findIdBy($recipe->getName()), PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            array_push($objects, new Ingredient($result["req_id"], $result["req_label"]));
        }
        return $objects;
    }
}