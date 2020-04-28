<?php

namespace App\Controllers;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Step;
use App\Models\Tag;
use App\Models\Ustencil;
use App\Services\IngredientManager;
use App\Services\RecipeManager;
use App\Services\RequirementManager;
use App\Services\StepManager;
use App\Services\TagManager;
use App\Services\UstencilManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
}
$member = unserialize($_SESSION["member"]);
$ingredients = IngredientManager::findAll();
$ustencils = UstencilManager::findAll();
$tags = TagManager::findAll();

if (count($_POST) > 0) {
    $errors = [];
    if (!count(json_decode($_POST["ingredients"])) > 0 || !count(json_decode($_POST["ustencils"])) > 0) {
        $errors[] = "Veuillez renseigner des ingrédients et des ustensiles.";
    }
    if (strlen($_POST["name"]) < 5) {
        $errors[] = "Le nom est trop court.";
    }
    if (strlen($_POST["description"]) < 20) {
        $errors[] = "La description est trop courte.";
    }
    $file = pathinfo(strtolower($_FILES["image"]["name"]));
    $imageName = $file["filename"];
    $imageExtension = $file["extension"];
    if (!in_array($imageExtension, ["jpeg", "jpg", "png"])) {
        $errors[] = "Le format de l'image doit être valide.";
    }
    if (!count($errors) > 0) {
        $md5Image = md5($imageName) . time() . "." . $imageExtension;
        $targetFolder = __DIR__ . "/../assets/images/" . $md5Image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFolder);
        $recipe = null;
        if (!strlen($_POST["advice"]) > 0) {
            $recipe = new Recipe(0, $_POST["name"], $_POST["description"], $md5Image, $_POST["difficulty"], $_POST["time"], $_POST["nbPersons"], $member, $_POST["type"]);
        } else {
            $recipe = new Recipe(0, $_POST["name"], $_POST["description"], $md5Image, $_POST["difficulty"], $_POST["time"], $_POST["nbPersons"], $member, $_POST["type"], $_POST["advice"]);
        }
        RecipeManager::insert($recipe);
        $recipe = RecipeManager::findOneBy($recipe->getName());
        foreach (json_decode($_POST["ustencils"]) as $ustencil) {
            RequirementManager::insertRequirementRecipe(UstencilManager::findOneBy($ustencil->name), $recipe, $ustencil->quantity);
        }
        foreach (json_decode($_POST["ingredients"]) as $ingredient) {
            RequirementManager::insertRequirementRecipe(IngredientManager::findOneBy($ingredient->name), $recipe, $ingredient->quantity);
        }
        foreach (json_decode($_POST["tags"]) as $tag) {
            TagManager::insert(new Tag(0, $tag->name), $recipe);
        }
        $steps = json_decode($_POST["steps"]);
        for ($i = 0; $i < count($steps); $i++) {
            StepManager::insert(new Step($steps[$i]->description, $i + 1, $recipe));
        }
        echo json_encode("success");
    } else {
        echo json_encode($errors);
    }
} else {
    require __DIR__ . "/../Views/member/publication_recipe.php";
}