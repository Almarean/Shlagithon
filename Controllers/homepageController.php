<?php

namespace App\Controllers;

use App\Services\RecipeManager;

$desserts = RecipeManager::findAllByType("DESSERT");
$plats = RecipeManager::findAllByType("PLAT");
$entrees = RecipeManager::findAllByType("ENTREE");


$platCaroussel = $plats[rand(0,count($plats)-1)];
$dessertCaroussel = $desserts[rand(0,count($desserts)-1)];
$entreeCaroussel = $entrees[rand(0,count($entrees)-1)];



require __DIR__ . "/../Views/homepage.php";