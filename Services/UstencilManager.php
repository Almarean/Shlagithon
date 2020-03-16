<?php

namespace App\Services;

use PDO;
use App\Interfaces\IManager;
use App\Models\Recipe;
use App\Models\Ustencil;

/**
 * Class UstencilManager implements IManager.
 */
class UstencilManager implements IManager
{
    /**
     * Insert a ustencil in database.
     *
     * @param Ustencil $object
     *
     * @return boolean
     */
    public static function insert($object): bool
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
            array_push($objects, new Ustencil($result["req_label"]));
        }
        return $objects;
    }

    /**
     * Fetch a ustencil.
     *
     * @param void $identifier
     *
     * @return null|Ustencil
     */
    public static function findOneBy($identifier): ?Ustencil
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM requirement WHERE req_label = :label AND req_type = 'USTENCIL';");
        $stmt->bindValue(":label", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? new Ustencil($result["req_label"]) : null;
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
            array_push($objects, new Ustencil($result["req_label"]));
        }
        return $objects;
    }
}