<?php

namespace App\Controllers;

use App\Services\RecipeManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
}

if (isset($_GET["edit"])) {
    $recipe = RecipeManager::findOneByID($_GET["edit"]);
}

if (isset($_POST["validate"])) {
    if (isset($_POST["name"]) && $_POST["description"] && $_POST["time"] && $_POST["difficulty"] && $_POST["nbPersons"]) {
        if (isset($_FILES["image"])) {
            $targetFolder = __DIR__ . "/../assets/images/" . basename($_FILES["image"]["name"]);
            RecipeManager::updateRecipe($_POST["validate"], $_POST["name"], $_POST["description"], $_FILES["image"]["name"], $_POST["difficulty"], $_POST["time"], $_POST["nbPersons"], $_POST["advice"], $_POST["type"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFolder);
        } else {
            RecipeManager::updateRecipe($_POST["validate"], $_POST["name"], $_POST["description"], "TODO", $_POST["difficulty"], $_POST["time"], $_POST["nbPersons"], $_POST["advice"], $_POST["type"]);
        }
        header("Location: recipe?edit=" . $_POST["validate"]);
    }
}

if (isset($_POST["return"])) {
    header("Location: recipes");
}

require __DIR__ . "/../Views/edit_recipe.php";