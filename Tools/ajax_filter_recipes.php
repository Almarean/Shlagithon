<?php

namespace App\Tools;

use App\Services\RecipeManager;

if (isset($_GET["type"]) && isset($_GET["filter"])) {
    if ($_GET["type"] === "tag") {
        echo json_encode(RecipeManager::findRecipeByTagName(strtolower($_GET["filter"])));
    } elseif ($_GET["type"] === "word") {
        echo json_encode(RecipeManager::findRecipesByText(strtolower($_GET["filter"])));
    }
}