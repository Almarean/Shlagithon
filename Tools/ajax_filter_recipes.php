<?php

namespace App\Tools;

use App\Services\RecipeManager;

if (isset($_GET["category"]) && isset($_GET["filter"])) {
    if ($_GET["category"] === "tag") {
        echo json_encode(RecipeManager::findRecipesByTagName(strtolower($_GET["filter"])));
    } elseif ($_GET["category"] === "word") {
        echo json_encode(RecipeManager::findRecipesByText(strtolower($_GET["filter"])));
    } elseif ($_GET["category"] === "type") {
        echo json_encode(RecipeManager::findRecipesByType(strtoupper($_GET["filter"])));
    }
}