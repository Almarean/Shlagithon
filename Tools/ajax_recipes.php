<?php

namespace App\Tools;

use App\Services\RecipeManager;

echo json_encode(RecipeManager::findRecipesByText(strtolower($_POST["filter"])));