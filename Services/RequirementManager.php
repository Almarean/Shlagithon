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
     * Find the quantity of the requirement.
     *
     * @param Requirement $requirement
     * @param Recipe $recipe
     *
     * @return string
     */
    public static function findRequirementQuantity(Requirement $requirement, Recipe $recipe): string
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT rr_quantity FROM recipe_requirement WHERE rr_fk_recipe_id = :recipeId AND rr_fk_requirement_id = :requirementId;");
        $stmt->bindValue(":recipeId", $recipe->getId(), PDO::PARAM_INT);
        $stmt->bindValue(":requirementId", $requirement->getId(), PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch()[0];
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
}