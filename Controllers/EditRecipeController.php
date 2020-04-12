<?php

namespace App\Controllers;

use App\Services\RecipeManager;

if (!isset($_SESSION["member"])) {
    header("Location: logout");
}

if (isset($_GET["edit"])) {
    $recipe = RecipeManager::findOneByID($_GET["edit"]);
}

if (isset($_POST["validate"])) {
    if (isset($_POST["name"]) && $_POST["description"] && $_POST["time"] && $_POST["difficulty"] && $_POST["nbPersons"]) {
        $errors = [];
        if (isset($_FILES["image"])) {
            $file = pathinfo(strtolower($_FILES["image"]["name"]));
            $imageName = $file["filename"];
            $imageExtension = $file["extension"];
            if (in_array($imageExtension, ["jpeg", "jpg", "png"])) {
                $md5Image = md5($imageName) . time() . "." . $imageExtension;
                $targetFolder = __DIR__ . "/../assets/images/" . $md5Image;
                move_uploaded_file($_FILES["image"]["tmp_name"], $targetFolder);
                RecipeManager::updateRecipe($_POST["validate"], $_POST["name"], $_POST["description"], $md5Image, $_POST["difficulty"], $_POST["time"], $_POST["nbPersons"], $_POST["advice"], $_POST["type"]);
            } else {
                $errors[] = "Le format de l'image doit être valide.";
            }
        }
        if (!count($errors) > 0) {
            header("Location: recipe?edit=" . $_POST["validate"] . "&success");
        } else {
            header("Location: recipe?edit=" . $_POST["validate"] . "&errors=" . urlencode(serialize($errors)));
        }
    }
}

require __DIR__ . "/../Views/member/edit_recipe.php";