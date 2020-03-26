<?php

namespace App\Controllers;

use App\Services\RecipeManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
} else if (isset($_SESSION["member"]) && unserialize($_SESSION["member"])->getType() !== "ADMIN") {
    header("Location: logout");
}

$recipes = RecipeManager::findAll();
if (isset($_GET["deleteId"])) {
    RecipeManager::deleteOneById($_GET["deleteId"]);
    header("Location: recipes-editor");
}
if (isset($_GET['editId'])) {
    header("Location: recipe-editor?editId=" . $_GET['editId']);
}

require __DIR__ . "/../Views/admin/admin_show_recipes.php";