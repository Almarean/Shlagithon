<?php

$request = $_SERVER["REQUEST_URI"];
session_start();
require_once __DIR__ . "/load.php";
if (preg_match("/index.php(\/[^ \?]+)\?*/", $request, $matches)) {
    $request = $matches[1];
    switch ($request) {
        case "/registration":
            if (isset($_SESSION["member"])) {
                header("Location: home");
            } else {
                require __DIR__ . "/Controllers/RegistrationController.php";
            }
            break;
        case "/login":
            if (isset($_SESSION["member"])) {
                header("Location: home");
            } else {
                require __DIR__ . "/Controllers/LoginController.php";
            }
            break;
        case "/logout":
            require __DIR__ . "/Controllers/LogoutController.php";
            break;
        case "/members-editor":
            require __DIR__ . "/Controllers/AdminShowMembersController.php";
            break;
        case "/member-editor":
            require __DIR__ . "/Controllers/AdminEditMembersController.php";
            break;
        case "/recipes-editor":
            require __DIR__ . "/Controllers/AdminShowRecipesControllers.php";
            break;
        case "/recipe-editor":
            require __DIR__ . "/Controllers/AdminEditRecipeController.php";
            break;
        case "/profile":
            require __DIR__ . "/Controllers/MemberEditProfileController.php";
            break;
        case "/recipes":
            require __DIR__ . "/Controllers/MemberShowRecipesController.php";
            break;
        case "/recipe-details":
            require __DIR__ . "/Controllers/MemberRecipeDetailsController.php";
            break;
        // Verify the email address.
        case "/verify":
            if (isset($_GET["email"]) && isset($_GET["hash"])) {
                require __DIR__ . "/Controllers/EmailVerifyController.php";
            } else {
                http_response_code(404);
            }
            break;
        // AJAX
        case "/filter-recipes":
            require __DIR__ . "/Tools/ajax_recipes.php";
            break;
        default:
            http_response_code(404);
            break;
    }
} else {
    require __DIR__ . "/Controllers/HomepageController.php";
}