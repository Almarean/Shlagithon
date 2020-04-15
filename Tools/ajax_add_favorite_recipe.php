<?php

namespace App\Tools;

use App\Services\RecipeManager;

$recipe = RecipeManager::findOneById(intval(json_decode($_POST["recipe-id"])));
$member = unserialize($_SESSION["member"]);
$member->addFavoriteRecipe($recipe);
RecipeManager::insertFavoriteRecipe($member, $recipe);