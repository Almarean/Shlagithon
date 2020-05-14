<?php

namespace App\Tools;

use App\Services\RecipeManager;

header("Cache-Control: private, no-cache, no-store, must-revalidate");
header("Content-Type: application/json;charset=utf-8");

if (isset($_GET['id']) && $_GET["id"] !== "") {
    $result = RecipeManager::findOneById($_GET['id'], false);
    if ($result !== null && $result !== false) {
        http_response_code(200);
        header("HTTP/1.1 200 OK");
        echo json_encode(array(
            "success" => true,
            "data" => $result
        ));
    } else {
        http_response_code(404);
        header("HTTP/1.1 404 Not found");
        echo json_encode(array(
            "success" => false,
            "message" => "Ressource introuvable."
        ));
    }
} else {
    $result = RecipeManager::findAll(false);
    if ($result !== null && $result !== false) {
        http_response_code(200);
        header("HTTP/1.1 200 OK");
        echo json_encode(array(
            "success" => true,
            "data" => $result
        ));
    } else {
        http_response_code(404);
        header("HTTP/1.1 404 Not found");
        echo json_encode(array(
            "success" => false,
            "message" => "Ressource introuvable."
        ));
    }
}