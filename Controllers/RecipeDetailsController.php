<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Services\AllergenManager;
use App\Services\CommentManager;
use App\Services\MemberManager;
use App\Services\RecipeManager;
use App\Services\RequirementManager;
use App\Services\StepManager;
use App\Services\TagManager;

if (isset($_GET["id"])) {
    $recipe = RecipeManager::findOneById($_GET["id"]);
    if (count($_POST) > 0 && isset($_SESSION["member"])) {
        if(isset($_POST["comment"])){
            $newComment = new Comment(0, $_POST["comment"], unserialize($_SESSION["member"]), $recipe);
            CommentManager::insert($newComment);
        }
        if(isset($_POST["favorite"])){
            if($_POST["favorite"]){
                RecipeManager::setFavoriteRecipe(unserialize($_SESSION["member"]), $recipe);
            } else {
                RecipeManager::removeFavoriteRecipe(unserialize($_SESSION["member"]), $recipe);
            }
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
    $commentaries = CommentManager::findByRecipe($recipe);
    $listFavorite = RecipeManager::findFavoriteRecipes(unserialize($_SESSION["member"]));
}

require __DIR__ . "/../Views/recipes_details.php";
