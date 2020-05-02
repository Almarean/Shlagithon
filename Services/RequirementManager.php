<?php

namespace App\Services;

use PDO;
use App\Models\Allergen;
use App\Models\Recipe;
use App\Models\Requirement;

/**
 * Class RequirementManager.
 *
 * @package App\Services
 */
class RequirementManager
{
    /**
     * Fetch all requirements by recipe.
     *
     * @param Recipe $recipe
     *
     * @return array
     */
    public static function findAllByRecipe(Recipe $recipe): array
    {
        return array_merge(IngredientManager::findAllByRecipe($recipe), UstencilManager::findAllByRecipe($recipe));
    }

    /**
     * Find the allergens of the requirement.
     *
     * @param Requirement $requirement
     *
     * @return array
     */
    public static function findRequirementAllergens(Requirement $requirement): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM allergen INNER JOIN requirement_allergen ON allergen.a_id = requirement_allergen.ra_fk_allergen_id WHERE ra_fk_requirement_id = :requirementId;");
        $stmt->bindValue(":requirementId", $requirement->getId(), PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            array_push($objects, new Allergen($result["a_id"], $result["a_label"]));
        }
        return $objects;
    }

    /**
     * Link an allergen to a requirement in the database.
     *
     * @param Requirement $requirement
     * @param Allergen $allergen
     *
     * @return boolean
     */
    public static function insertRequirementAllergen(Requirement $requirement, Allergen $allergen): bool
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO requirement_allergen (ra_fk_requirement_id, ra_fk_allergen_id) VALUES (:requirementId, :allergenId);");
        $stmt->bindValue(":requirementId", $requirement->getId(), PDO::PARAM_INT);
        $stmt->bindValue(":allergenId", $allergen->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Link a requirement to a recipe in the database.
     *
     * @param Requirement $requirement
     * @param Recipe $recipe
     * @param string $quantity
     *
     * @return boolean
     */
    public static function insertRequirementRecipe(Requirement $requirement, Recipe $recipe, string $quantity): bool
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO recipe_requirement (rr_fk_recipe_id, rr_fk_requirement_id, rr_quantity) VALUES (:recipeId, :requirementId, :quantity);");
        $stmt->bindValue(":recipeId", $recipe->getId(), PDO::PARAM_INT);
        $stmt->bindValue(":requirementId", $requirement->getId(), PDO::PARAM_INT);
        $stmt->bindValue(":quantity", $quantity, PDO::PARAM_STR);
        return $stmt->execute();
    }
}