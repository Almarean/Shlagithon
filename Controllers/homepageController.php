<?php

namespace App\Controllers;

use App\Services\RecipeManager;

$entrees = RecipeManager::findAllByType("ENTREE");
$dishes = RecipeManager::findAllByType("PLAT");
$desserts = RecipeManager::findAllByType("DESSERT");
$others = RecipeManager::findAllByType("AUTRE");

$carouselRecipes = [];
if (count($entrees) > 0) {
    array_push($carouselRecipes, $entrees[rand(0, count($entrees) - 1)]);
}
if (count($dishes) > 0) {
    array_push($carouselRecipes, $dishes[rand(0, count($dishes) -1)]);
}
if (count($desserts) > 0) {
    array_push($carouselRecipes, $desserts[rand(0, count($desserts) - 1)]);
}

require __DIR__ . "/../Views/homepage.php";