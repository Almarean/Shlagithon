<?php

namespace App\Controllers;

use App\Models\Recipe;
use App\Services\IngredientManager;
use App\Services\RecipeManager;
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
    // $postData = json_decode($_POST["data"]);
    var_dump($_POST);
    exit();
    $errors = [];
    if (!count($postData->ingredients) > 0 || !count($postData->ustencils) > 0) {
        $errors[] = "Veuillez renseigner des ingrédients et des ustensiles.";
    }
    if (strlen($postData->name) < 5) {
        $errors[] = "Le nom est trop court.";
    }
    if (strlen($postData->description) < 20) {
        $errors[] = "La description est trop courte.";
    }
    // $file = pathinfo(strtolower($_FILES["image"]["name"]));
    // $imageName = $file["filename"];
    // $imageExtension = $file["extension"];
    // if (!in_array($imageExtension, ["jpeg", "jpg", "png"])) {
    //     $errors[] = "Le format de l'image doit être valide.";
    // }
    if (!count($errors) > 0) {
        // $md5Image = md5($imageName) . time() . "." . $imageExtension;
        // $targetFolder = __DIR__ . "/../assets/images/" . $md5Image;
        // move_uploaded_file($_FILES["image"]["tmp_name"], $targetFolder);
        $recipe = null;
        if (!strlen($postData->advice) > 0) {
            $recipe = new Recipe(0, $postData->name, $postData->description, "md5Image", $postData->difficulty, $postData->time, $postData->nbPersons, $member, $postData->type);
            RecipeManager::insert($recipe);
        } else {
            $recipe = new Recipe(0, $postData->name, $postData->description, "md5Image", $postData->difficulty, $postData->time, $postData->nbPersons, $member, $postData->type, $postData->advice);
            RecipeManager::insert($recipe);
        }
        foreach ($postData->ustencils as $ustencil) {
            UstencilManager::insert($ustencil, $recipe);
        }
        foreach ($postData->ingredients as $ingredient) {
            IngredientManager::insert($ingredient, $recipe);
        }
        foreach ($postData->tags as $tag) {
            TagManager::insert($tag, $recipe);
        }
        header("Location: publication?success");
    }
}

require __DIR__ . "/../Views/member/publication_recipe.php";