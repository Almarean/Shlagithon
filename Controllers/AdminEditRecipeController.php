<?php
namespace App\Controllers;
use App\Services\RecipeManager;

session_start();

if (!isset($_SESSION["member"])) {
    header("Location: logout");
} else if (isset($_SESSION["member"]) && unserialize($_SESSION["member"])->getType() !== "ADMIN") {
    header("Location: logout");
}

if (isset($_GET['editId'])) {
    $recipe = RecipeManager::findOneByID($_GET["editId"]);
}

require __DIR__ . "/../Views/admin/admin_edit_recipe.php";