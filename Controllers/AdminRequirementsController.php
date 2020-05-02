<?php

namespace App\Controllers;

use App\Models\Allergen;
use App\Models\Ingredient;
use App\Models\Tag;
use App\Models\Ustencil;
use App\Services\AllergenManager;
use App\Services\IngredientManager;
use App\Services\RequirementManager;
use App\Services\TagManager;
use App\Services\UstencilManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
} elseif (isset($_SESSION["member"]) && unserialize($_SESSION["member"])->getType() !== "ADMIN") {
    header("Location: logout");
}
$member = unserialize($_SESSION["member"]);

if (isset($_POST["category"])) {
    $data["requirements"] = [];
    switch ($_POST["category"]) {
        case "ustencil":
            $ustencils = UstencilManager::findAll();
            foreach ($ustencils as $ustencil) {
                array_push($data["requirements"], ["id" => $ustencil->getId(), "label" => $ustencil->getLabel()]);
            }
            break;
        case "ingredient":
            $data["allergens"] = [];
            $ingredients = IngredientManager::findAll();
            foreach ($ingredients as $ingredient) {
                array_push($data["requirements"], ["id" => $ingredient->getId(), "label" => $ingredient->getLabel()]);
            }
            $allergens = AllergenManager::findAll();
            foreach($allergens as $allergen) {
                array_push($data["allergens"], ["id" => $allergen->getId(), "label" => $allergen->getLabel()]);
            }
            break;
        case "tag":
            $tags = TagManager::findAll();
            foreach ($tags as $tag) {
                array_push($data["requirements"], ["id" => $tag->getId(), "label" => $tag->getLabel()]);
            }
            break;
        case "allergen":
            $allergens = AllergenManager::findAll();
            foreach ($allergens as $allergen) {
                array_push($data["requirements"], ["id" => $allergen->getId(), "label" => $allergen->getLabel()]);
            }
            break;
    }
    echo json_encode($data);
} elseif (isset($_POST["remove"]) && isset($_POST["type"])) {
    switch ($_POST["type"]) {
        case "ingredient":
            echo IngredientManager::deleteOneById($_POST["remove"]);
            break;
        case "ustencil":
            echo UstencilManager::deleteOneById($_POST["remove"]);
            break;
        case "tag":
            echo TagManager::deleteOneById($_POST["remove"]);
            break;
        case "allergen":
            echo AllergenManager::deleteOneById($_POST["remove"]);
            break;
    }
} elseif (isset($_POST["insert"]) && isset($_POST["type"])) {
    switch ($_POST["type"]) {
        case "ingredient":
            if (IngredientManager::insertIngredient(new Ingredient(0, $_POST["insert"], 0))) {
                $ingredient = IngredientManager::findOneBy($_POST["insert"]);
                if (isset($_POST["allergen"]) && $_POST["allergen"] !== "0") {
                    RequirementManager::insertRequirementAllergen($ingredient, AllergenManager::findOneById($_POST["allergen"]));
                }
                echo $ingredient->getId();
            } else {
                echo 0;
            }
            break;
        case "ustencil":
            if (UstencilManager::insertUstencil(new Ustencil(0, $_POST["insert"], 0))) {
                echo UstencilManager::findIdBy($_POST["insert"]);
            } else {
                echo 0;
            }
            break;
        case "tag":
            if (TagManager::insertTag(new Tag(0, $_POST["insert"], 0))) {
                echo TagManager::findIdBy($_POST["insert"]);
            } else {
                echo 0;
            }
            break;
        case "allergen":
            if (AllergenManager::insert(new Allergen(0, $_POST["insert"], 0))) {
                echo AllergenManager::findIdBy($_POST["insert"]);
            } else {
                echo 0;
            }
            break;
    }
} else {
    require __DIR__ . "/../Views/admin/admin_manage_requirements.php";
}