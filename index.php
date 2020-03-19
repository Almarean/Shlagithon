<?php

$request = $_SERVER["REQUEST_URI"];
if (preg_match("/index.php(\/[^ \?]+)\?*/", $request, $matches)) {
    $request = $matches[1];

    require_once __DIR__ . "/autoload.php";

    switch ($request) {
        case '/test':
            require __DIR__ . "/Controllers/test.php";
            break;
        case "/registration":
            require __DIR__ . "/Controllers/RegistrationController.php";
            break;
        case "/login":
            require __DIR__ . "/Controllers/LoginController.php";
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
        case "/recipe":
            require __DIR__ . "/Controllers/RecipeController.php";
            break;
        case "/member-profile":
            require __DIR__ . "/Controllers/MemberProfileController.php";
            break;
        default:
            http_response_code(404);
            break;
    }
}else{
    http_response_code(404);
}

