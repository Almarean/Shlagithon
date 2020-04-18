<?php

namespace App\Controllers;

use App\Services\RecipeManager;
use App\Services\TagManager;

$member = null;
if (isset($_SESSION["member"])) {
    $member = unserialize($_SESSION["member"]);
}

$entrees = RecipeManager::findAllByType("ENTREE");
$dishes = RecipeManager::findAllByType("PLAT");
$desserts = RecipeManager::findAllByType("DESSERT");
$others = RecipeManager::findAllByType("AUTRE");
$tags = TagManager::findAll();

$carouselRecipes = [];
if (count($entrees) > 0) {
    array_push($carouselRecipes, $entrees[rand(0, count($entrees) - 1)]);
}
if (count($dishes) > 0) {
    array_push($carouselRecipes, $dishes[rand(0, count($dishes) - 1)]);
}
if (count($desserts) > 0) {
    array_push($carouselRecipes, $desserts[rand(0, count($desserts) - 1)]);
}

// Ne fonctionne pas
if (isset($_GET["filter"])) {
    $filteredRecipes = RecipeManager::findRecipesByText(strtolower($_GET["filter"]), true);
    echo $twig->render("homepage.twig", [
        "entrees" => $entrees,
        "dishes" => $dishes,
        "desserts" => $desserts,
        "others" => $others,
        "carousel_recipes" => $carouselRecipes,
        "fitered_recipes" => $filteredRecipes,
        "member" => $member
    ]);
}

echo $twig->render("homepage.twig", [
    "entrees" => $entrees,
    "dishes" => $dishes,
    "desserts" => $desserts,
    "others" => $others,
    "carousel_recipes" => $carouselRecipes,
    "member" => $member
]);
// require __DIR__ . "/../Views/homepage.php";