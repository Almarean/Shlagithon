<?php

namespace App\Controllers;

use App\Services\RecipeManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
}
$member = unserialize($_SESSION["member"]);
if (!$member->getIsConfirmed()) {
    header("Location: logout");
}

$member->setWrittenRecipes(RecipeManager::findWrittenRecipes($member));
$_SESSION["member"] = serialize($member);
$member = unserialize($_SESSION["member"]);

if (isset($_GET["id"])) {
    header("Location: recipe-details?id=" . $_GET["id"]);
}

require __DIR__ . "/../Views/member/member_show_recipes.php";