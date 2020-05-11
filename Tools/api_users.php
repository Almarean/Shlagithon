<?php

namespace App\Tools;

use App\Services\MemberManager;

header("Content-Type: application/json;charset=utf-8");
header("Cache-Control: private, no-cache, no-store, must-revalidate");
if(isset($_GET['id']) && $_GET["id"] != ""){
    $result = MemberManager::findOneById($_GET['id'], false);
    if($result != null && $result != false){
        http_response_code(200);
        header("HTTP/1.1 200 OK");
        echo json_encode(array(
            "success" => true,
            "data" => $result->getApiFormat()
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
    $result = MemberManager::findAll(false);
    if($result != null && $result != false){
        foreach ($result as $key => $value) {
            $result[$key] = $value->getApiFormat();
        }
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
