<?php

namespace App\Controllers;


use App\Services\AllergenManager;
use App\Services\IngredientManager;
use App\Services\TagManager;
use App\Services\UstencilManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
} else if (isset($_SESSION["member"]) && unserialize($_SESSION["member"])->getType() !== "ADMIN") {
    header("Location: logout");
}
$member = unserialize($_SESSION["member"]);


if(isset($_GET["filter"])){
    if($_GET["filter"] === "ustencil"){
        $ustencils = UstencilManager::findAll();
    } elseif ($_GET["filter"] === "tag"){
        $tags = TagManager::findAll();
    } elseif ($_GET["filter"] === "ingredient"){
        $ingredients = IngredientManager::findAll();
    }
    $formName = $_GET["filter"];
} else {
    $formName = "allergene";
    $allergenes = AllergenManager::findAll();
}

if(isset($_GET["exists"])){

}

require __DIR__ . "/../Views/admin/admin_manage_allergenes.php";
