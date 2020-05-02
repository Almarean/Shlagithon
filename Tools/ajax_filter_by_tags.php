<?php

namespace App\Tools;

use App\Services\RecipeManager;

echo json_encode(RecipeManager::findRecipeByTagName(strtolower($_POST["tag"])));