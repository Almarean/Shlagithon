<?php

namespace App\Controllers;

use App\Services\RecipeManager;

if (isset($_GET['recipeId'])) {
    $recipe = RecipeManager::findOneBy($_GET['recipeId']);
    var_dump($recipe);
}