<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Services\AllergenManager;
use App\Services\CommentManager;
use App\Services\RecipeManager;
use App\Services\RequirementManager;
use App\Services\StepManager;
use App\Services\TagManager;

if (isset($_GET["id"])) {
    $recipe = RecipeManager::findOneById($_GET["id"]);
    if (isset($_SESSION["member"])) {
        $member = unserialize($_SESSION["member"]);
        $member->setFavoriteRecipes(RecipeManager::findFavoriteRecipes($member));
        $inArray = false;
        foreach ($member->getFavoriteRecipes() as $favoriteRecipe) {
            if ($favoriteRecipe->getId() === $recipe->getId()) {
                $inArray = true;
            }
        }
        if (isset($_POST["comment"]) && strlen(trim($_POST["comment"])) > 0) {
            $newComment = new Comment(0, $_POST["comment"], unserialize($_SESSION["member"]), $recipe, date("Y-m-d H:i:s"));
            CommentManager::insert($newComment);
            header("Location: recipe-details?id=" . $_GET["id"]);
        }
    }
    $recipe->setSteps(StepManager::findAllByRecipe($recipe));
    $requirements = RequirementManager::findAllByRecipe($recipe);
    $allergens = [];
    foreach ($requirements as $requirement) {
        if (get_class($requirement) === "App\\Models\\Ingredient") {
            $requirement->setAllergens(AllergenManager::findAllByIngredient($requirement));
            $allergens = array_merge($allergens, $requirement->getAllergens());
        }
    }
    $allergens = array_unique($allergens, SORT_REGULAR);
    $ustencils = array_filter($requirements, function ($requirement) {
        return get_class($requirement) === "App\\Models\\Ustencil";
    });
    $ingredients = array_filter($requirements, function ($requirement) {
        return get_class($requirement) === "App\\Models\\Ingredient";
    });
    $recipe->setTags(TagManager::findAllByRecipe($recipe));
    $recipe->setRequirements($requirements);
    $commentaries = CommentManager::findByRecipe($recipe);
}

require __DIR__ . "/../Views/recipes_details.php";