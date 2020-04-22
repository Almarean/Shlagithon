<?php

namespace App\Tools;
use App\Models\Ingredient;
use App\Models\Tag;
use App\Models\Ustencil;
use App\Services\IngredientManager;
use App\Services\TagManager;
use App\Services\UstencilManager;


// Traitement ingredient
////
if(isset($_POST["test-ingredient"])){
    echo IngredientManager::exists($_POST["test-ingredient"]);
}

if(isset($_POST["add-ingredient"])){
    $ingredient = new Ingredient(0,$_POST["add-ingredient"],0);
    echo IngredientManager::insertIngredient($ingredient);
}
if(isset($_POST["rm-ingredient"])){
    echo IngredientManager::deleteOneById($_POST["rm-ingredient"]);
}

if(isset($_POST["getid-ingredient"])){
    $ingredient = IngredientManager::findIdBy($_POST["getid-ingredient"]);
    echo $ingredient;
}
////
/// Traitement tag
///
if(isset($_POST["test-tag"])){
    echo TagManager::exists($_POST["test-tag"]);
}
if(isset($_POST["add-tag"])){
    $tag = new Tag(0,$_POST["add-tag"]);
    echo TagManager::insertTag($tag);
}

if(isset($_POST["rm-tag"])){
    $tag = new Ustencil(0,$_POST["rm-tag"],0);
    echo TagManager::deleteOneById($tag);
}

if(isset($_POST["getid-tag"])){
    $tag = TagManager::findIdBy($_POST["getid-tag"]);
    echo $tag;
}
////
/// Traitement Ustencil
///
if(isset($_POST["test-ustencil"])){
    echo UstencilManager::exists($_POST["test-ustencil"]);
}

if(isset($_POST["add-ustencil"])){
    $ustencil = new Ustencil(0,$_POST["add-ustencil"],0);
    echo UstencilManager::insertUstencil($ustencil);
}

if(isset($_POST["rm-ustencil"])){
    $ustencil = new Ustencil(0,$_POST["rm-ustencil"],0);
    echo UstencilManager::deleteOneById($ustencil);
}

if(isset($_POST["getid-ustencil"])){
    $ustencil = UstencilManager::findIdBy($_POST["getid-ustencil"]);
    echo $ustencil;
}
////