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
            $image_name = explode(".",basename($_FILES["image"]["name"]))[0] . date('Y-m-d');
            $image_extension = explode(".",basename($_FILES["image"]["name"]))[1];
            $md5_image = md5($image_name) . ".". $image_extension;
            $targetFolder = __DIR__ . "/../assets/images/" . $md5_image;
            RecipeManager::updateRecipe($_POST["validate"], $_POST["name"], $_POST["description"], $md5_image, $_POST["difficulty"], $_POST["time"], $_POST["nbPersons"], $_POST["advice"], $_POST["type"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFolder);
        }
        header("Location: recipe?edit=" . $_POST["validate"]);
    }
}

if (isset($_POST["return"])) {
    header("Location: recipes");
}

require __DIR__ . "/../Views/edit_recipe.php";