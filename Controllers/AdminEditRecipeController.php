<?php

namespace App\Controllers;

use App\Services\RecipeManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
} else if (isset($_SESSION["member"]) && unserialize($_SESSION["member"])->getType() !== "ADMIN") {
    header("Location: logout");
}

if (isset($_GET['editId'])) {
    $recipe = RecipeManager::findOneByID($_GET["editId"]);
}

if (isset($_POST["validate"])) {
    if (isset($_POST["name"]) && $_POST["description"] && $_POST["time"] && $_POST["difficulty"] && $_POST["nbPersons"]) {
        RecipeManager::updateRecipe($_POST["validate"], $_POST["name"], $_POST["description"], "TODO", $_POST["difficulty"], $_POST["time"], $_POST["nbPersons"], $_POST["advice"], $_POST["type"]);
        header("Location: recipe-editor?editId=" . $_POST["validate"]);
    }
}

if (isset($_POST["return"])) {
    header("Location: recipes-editor");
}

require __DIR__ . "/../Views/admin/admin_edit_recipe.php";