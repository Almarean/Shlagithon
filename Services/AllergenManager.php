<?php

namespace App\Services;

use PDO;
use App\Interfaces\IManager;
use App\Models\Allergen;
use App\Models\Ingredient;
use App\Services\PDOManager;

/**
 * Class AllergenManager implements IManager.
 */
class AllergenManager implements IManager
{
    /**
     * Insert an allergen in database.
     *
     * @param Allergen $object
     *
     * @return boolean
     */
    public static function insert($object): bool
    {
        if (get_class($object) === "App\\Models\\Allergen") {
            if (self::exists($object->getLabel())) {
                return false;
            }
            $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO allergen(a_label) VALUES (:label);");
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
        $stmt = PDOManager::getInstance()->getPDO()->query("SELECT * FROM allergen;");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach($results as $result) {
            array_push($objects, new Allergen($result["a_label"]));
        }
        return $objects;
    }

    /**
     * Fetch an allergen.
     *
     * @param void $identifier
     * @param bool $convertIntoObject
     *
     * @return Allergen|array|null
     */
    public static function findOneBy($identifier, bool $convertIntoObject = true)
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM allergen WHERE a_label = :label;");
        $stmt->bindValue(":label", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$convertIntoObject) {
            return $result;
        }
        return $result ? new Allergen($result["a_label"]) : null;
    }

    /**
     * Fetch the ID of the allergen.
     *
     * @param void $identifier
     *
     * @return integer|null
     */
    public static function findIdBy($identifier): ?int
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT a_id FROM allergen WHERE a_label = :label;");
        $stmt->bindValue(":label", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result["a_id"] : null;
    }

    /**
     * Fetch all the allergens by the ingredient.
     *
     * @param Ingredient $ingredient
     *
     * @return array
     */
    public static function findAllByIngredient(Ingredient $ingredient): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM allergen INNER JOIN requirement_allergen ON allergen.a_id = requirement_allergen.ra_fk_allergen_id WHERE ra_fk_requirement_id = :ingredientId;");
        $stmt->bindValue(":ingredientId", IngredientManager::findIdBy($ingredient->getLabel()));
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            array_push($objects, new Allergen($result["a_label"]));
        }
        return $objects;
    }

    /**
     * Verify if the allergen exists.
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