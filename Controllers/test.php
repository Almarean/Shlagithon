<?php

namespace App\Controllers;

use App\Models\Member;
use App\Models\Tag;
use App\Models\Recipe;
use App\Services\MemberManager;
use App\Services\TagManager;
use App\Services\RecipeManager;

$t = new Tag("letag");
TagManager::insert($t);
$tags = TagManager::fetchAll();

$m = new Member("laure", "thomas", "thomaslaure3@gmail.com", "password");
MemberManager::insert($m);
//$members1 = MemberManager::getAll(); // BUG

$r = new Recipe("Oeuf dur", "Je suis un oeuf dur", "bref.png", 1, 2, 1, "Une conseil", $m);
RecipeManager::insert($r);

include(__DIR__ . "/../Views/home.php");