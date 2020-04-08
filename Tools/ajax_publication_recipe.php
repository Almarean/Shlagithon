<?php

namespace App\Tools;

use App\Models\Allergen;
use App\Models\Ingredient;
use App\Models\Tag;
use App\Models\Ustencil;
use App\Services\AllergenManager;
use App\Services\IngredientManager;
use App\Services\TagManager;
use App\Services\UstencilManager;

$ustencilsJson = json_decode($_POST["ustencils"]);
$ingredientsJson = json_decode($_POST["ingredients"]);
$tagsJson = json_decode($_POST["tags"]);
$allergensJson = json_decode($_POST["allergens"]);
$ustencils = [];
$ingredients = [];
$tags = [];
$allergens = [];

foreach ($ustencilsJson as $ustencil) {
    $ustencilObject = null;
    if (UstencilManager::exists($ustencil->{"name"})) {
        $ustencilObject = UstencilManager::findOneBy($ustencil->{"name"});
    } else {
        $ustencilObject = new Ustencil(0, $ustencil->{"name"}, $ustencil->{"quantity"});
    }
    array_push($ustencils, $ustencilObject);
}

foreach ($ingredientsJson as $ingredient) {
    $ingredientObject = null;
    if (IngredientManager::exists($ingredient->{"name"})) {
        $ingredientObject = IngredientManager::findOneBy($ingredient->{"name"});
    } else {
        $ingredientObject = new Ingredient(0, $ingredient->{"name"}, $ingredient->{"quantity"});
    }
    array_push($ingredients, $ingredientObject);
}

foreach ($tagsJson as $tag) {
    $tagObject = null;
    if (TagManager::exists($tag->{"name"})) {
        $tagObject = TagManager::findOneBy($tag->{"name"});
    } else {
        $tagObject = new Tag(0, $tag->{"name"});
    }
    array_push($tags, $tagObject);
}

foreach ($allergensJson as $allergen) {
    $allergenObject = null;
    if (AllergenManager::exists($allergen->{"name"})) {
        $allergenObject = AllergenManager::findOneBy($allergen->{"name"});
    } else {
        $allergenObject = new Allergen(0, $allergen->{"name"});
    }
    array_push($allergens, $allergenObject);
}

$_SESSION["ustencils"] = serialize($ustencils);
$_SESSION["ingredients"] = serialize($ingredients);
$_SESSION["tags"] = serialize($tags);
$_SESSION["allergens"] = serialize($allergens);