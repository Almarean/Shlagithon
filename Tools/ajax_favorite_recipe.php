<?php

namespace App\Tools;

use App\Services\RecipeManager;

$recipe = RecipeManager::findOneById(intval(json_decode($_POST["recipe-id"])));
if (isset($_POST["action"]) && $_POST["action"] === "add") {
    RecipeManager::insertFavoriteRecipe(unserialize($_SESSION["member"]), $recipe);
} elseif (isset($_POST["action"]) && $_POST["action"] === "delete") {
    RecipeManager::removeFavoriteRecipe(unserialize($_SESSION["member"]), $recipe);
}