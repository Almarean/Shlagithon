<?php

namespace App\Services;

use PDO;
use App\Interfaces\IRequirementManager;
use App\Models\Recipe;
use App\Models\Ustencil;

/**
 * Class UstencilManager implements IRequirementManager.
 */
class UstencilManager implements IRequirementManager
{
    /**
     * Insert a ustencil and a recipe in database.
     *
     * @param Ustencil $object
     * @param Recipe $recipe
     *
     * @return boolean
     */
    public static function insert($object, Recipe $recipe): bool
    {
        if (get_class($object) === "App\\Models\\Ustencil") {
            if (self::exists($object->getLabel())) {
                return false;
            }
            $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO requirement(req_label, req_type) VALUES (:label, 'USTENCIL');");
            $stmt->bindValue(":label", $object->getLabel(), PDO::PARAM_STR);
            $stmtReq = $stmt->execute();
            $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO recipe_requirement(rr_fk_recipe_id, rr_fk_requirement_id, rr_quantity) VALUES (:recipeId, :requirementId, :quantity);");
            $stmt->bindValue(":recipeId", RecipeManager::findIdBy($recipe->getName()), PDO::PARAM_INT);
            $stmt->bindValue(":requirementId", self::findIdBy($object->getLabel()), PDO::PARAM_INT);
            $stmt->bindValue(":quantity", $object->getQuantity(), PDO::PARAM_STR);
            $stmtRR = $stmt->execute();
            return $stmtReq && $stmtRR;
        } else {
            return false;
        }
    }

    /**
     * Insert an ustencil in database.
     *
     * @param Ustencil $object
     *
     * @return boolean
     */
    public static function insertUstencil($object): bool
    {
        if (get_class($object) === "App\\Models\\Ustencil") {
            if (self::exists($object->getLabel())) {
                return false;
            }
            $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO requirement(req_label, req_type) VALUES (:label, 'USTENCIL');");
            $stmt->bindValue(":label", $object->getLabel(), PDO::PARAM_STR);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Find the quantity of a ustencil in a recipe.
     *
     * @param Recipe $recipe
     * @param Ustencil $ustencil
     *
     * @return string
     */
    public static function findQuantityByRecipeAndRequirement(Recipe $recipe, Ustencil $ustencil): string
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM recipe_requirement WHERE rr_fk_recipe_id = :recipeId AND rr_fk_requirement_id = :requirementId;");
        $stmt->bindValue(":recipeId", $recipe->getId(), PDO::PARAM_INT);
        $stmt->bindValue(":requirementId", $ustencil->getId(), PDO::PARAM_INT);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result["rr_quantity"] : "0";
    }

    /**
     * Fetch all ustencils in database.
     *
     * @return array
     */
    public static function findAll(): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->query("SELECT * FROM requirement WHERE req_type = 'USTENCIL';");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach($results as $result) {
            array_push($objects, new Ustencil($result["req_id"], $result["req_label"], 0));
        }
        return $objects;
    }

    /**
     * Fetch a ustencil.
     *
     * @param void $identifier
     * @param bool $convertIntoObject
     *
     * @return null|Ustencil|array
     */
    public static function findOneBy($identifier, bool $convertIntoObject = true)
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM requirement INNER JOIN recipe_requirement ON requirement.req_id = recipe_requirement.rr_fk_requirement_id WHERE req_label = :label AND req_type = 'USTENCIL';");
        $stmt->bindValue(":label", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$convertIntoObject) {
            return $result;
        }
        return $result ? new Ustencil($result["req_id"], $result["req_label"], $result["rr_quantity"]) : null;
    }

    /**
     * Fetch the ID of the ustencil.
     *
     * @param void $identifier
     *
     * @return integer|null
     */
    public static function findIdBy($identifier): ?int
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT req_id FROM requirement WHERE req_label = :label AND req_type = 'USTENCIL';");
        $stmt->bindValue(":label", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result["req_id"] : null;
    }

    /**
     * Verify if the ustencil exists.
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
     * Fetch all ustencils by recipe.
     *
     * @param Recipe $recipe
     *
     * @return array
     */
    public static function findAllByRecipe(Recipe $recipe): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM requirement INNER JOIN recipe_requirement ON requirement.req_id = recipe_requirement.rr_fk_requirement_id WHERE rr_fk_recipe_id = :recipeId AND req_type = 'USTENCIL';");
        $stmt->bindValue(":recipeId", RecipeManager::findIdBy($recipe->getName()), PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            array_push($objects, new Ustencil($result["req_id"], $result["req_label"], $result["rr_quantity"]));
        }
        return $objects;
    }

    /**
     * Remove an ustencil from database.
     *
     * @param int $identifier
     * @return bool
     */
    public static function deleteOneById($identifier): bool
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("DELETE FROM requirement WHERE req_id = :id;");
        $stmt->bindValue(":id", $identifier, PDO::PARAM_INT);
        return $stmt->execute();
    }
}