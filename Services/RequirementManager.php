<?php

namespace App\Services;

use App\Models\Recipe;

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
}