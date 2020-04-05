<?php

namespace App\Controllers;

use App\Services\AllergenManager;
use App\Services\RecipeManager;
use App\Services\RequirementManager;
use App\Services\StepManager;
use App\Services\TagManager;

if (isset($_GET["id"])) {
    $recipe = RecipeManager::findOneById($_GET["id"]);
    $recipe->setSteps(StepManager::findAllByRecipe($recipe));
    $requirements = RequirementManager::findAllByRecipe($recipe);
    $allergens = [];
    foreach ($requirements as $requirement) {
        if (get_class($requirement) === "App\\Models\\Ingredient") {
            $requirement->setAllergens(AllergenManager::findAllByIngredient($requirement));
            $allergens = array_merge($allergens, $requirement->getAllergens());
        }
        $requirement->setQuantity(RequirementManager::findRequirementQuantity($requirement, $recipe));
    }
    $allergens = array_unique($allergens);
    $ustencils = array_filter($requirements, function ($requirement) {
        return get_class($requirement) === "App\\Models\\Ustencil";
    });
    $ingredients = array_filter($requirements, function ($requirement) {
        return get_class($requirement) === "App\\Models\\Ingredient";
    });
    $recipe->setTags(TagManager::findAllByRecipe($recipe));
    $recipe->setRequirements($requirements);
}

require __DIR__ . "/../Views/recipes_details.php";
