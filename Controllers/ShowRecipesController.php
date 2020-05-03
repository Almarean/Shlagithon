<?php

namespace App\Controllers;

use App\Services\RecipeManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
}
$member = unserialize($_SESSION["member"]);

if (isset($_GET["admin"]) && $member->getType() === "ADMIN") {
    $recipes = RecipeManager::findAll();
} elseif (isset($_GET["favorite"])) {
    $recipes = RecipeManager::findFavoriteRecipes($member);
} else {
    $member->setWrittenRecipes(RecipeManager::findWrittenRecipes($member));
    $_SESSION["member"] = serialize($member);
    $member = unserialize($_SESSION["member"]);
    $recipes = $member->getWrittenRecipes();
}

if (isset($_GET["delete"])) {
    RecipeManager::deleteOneById($_GET["delete"]);
    if (isset($_GET["admin"])) {
        header("Location: recipes?admin");
    } else {
        header("Location: recipes");
    }
}
if (isset($_GET["edit"])) {
    header("Location: recipe?edit=" . $_GET["edit"]);
}
if (isset($_GET["id"])) {
    header("Location: recipe-details?id=" . $_GET["id"]);
}
if (isset($_GET["favorite-id"])) {
    RecipeManager::removeFavoriteRecipe($member, RecipeManager::findOneById($_GET["favorite-id"]));
    header("Location: ?favorite");
}

require __DIR__ . "/../Views/member/show_recipes.php";