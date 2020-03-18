<?php

namespace App\Controllers;

use App\Models\Allergen;
use App\Models\Ingredient;
use App\Models\Member;
use App\Models\Recipe;
use App\Models\Step;
use App\Models\Tag;
use App\Models\Ustencil;

use App\Services\AllergenManager;
use App\Services\IngredientManager;
use App\Services\MemberManager;
use App\Services\RecipeManager;
use App\Services\StepManager;
use App\Services\TagManager;
use App\Services\UstencilManager;

if (isset($_GET['recipeId'])) {
    $recipe = RecipeManager::findOneBy($_GET['recipeId']);
    var_dump($recipe);
}