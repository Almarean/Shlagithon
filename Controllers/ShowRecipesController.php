<?php

namespace App\Controllers;

use App\Services\RecipeManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
}
$member = unserialize($_SESSION["member"]);

if (isset($_GET["admin"])) {
    $recipes = RecipeManager::findAll();
} else {
    if (isset($_SESSION["member"]) && unserialize($_SESSION["member"])->getType() !== "ADMIN") {
        header("Location: logout");
    }
    $member->setWrittenRecipes(RecipeManager::findWrittenRecipes($member));
    $_SESSION["member"] = serialize($member);
    $member = unserialize($_SESSION["member"]);
    $recipes = $member->getWrittenRecipes();
}

if (isset($_GET["delete-id"])) {
    RecipeManager::deleteOneById($_GET["delete-id"]);
    header("Location: recipes-editor");
}
if (isset($_GET["edit-id"])) {
    header("Location: recipe-editor?edit-id=" . $_GET["edit-id"]);
}
if (isset($_GET["id"])) {
    header("Location: recipe-details?id=" . $_GET["id"]);
}

require __DIR__ . "/../Views/show_recipes.php";