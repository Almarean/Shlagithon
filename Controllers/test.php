<?php

namespace App\Controllers;

use App\Models\Allergen;
use App\Models\Ingredient;
use App\Models\Member;
use App\Models\Step;
use App\Models\StepManager;
use App\Models\Tag;
use App\Models\Recipe;
use App\Models\Ustencil;
use App\Services\AllergenManager;
use App\Services\IngredientManager;
use App\Services\MemberManager;
use App\Services\RequirementManager;
use App\Services\TagManager;
use App\Services\RecipeManager;
use App\Services\UstencilManager;

$t = new Tag("untag");
TagManager::insert($t);
$tags = TagManager::findAll();

$a = new Allergen("unallergen");
AllergenManager::insert($a);
$a2 = new Allergen("lallergen");
AllergenManager::insert($a2);
$allergens = AllergenManager::findAll();

$u = new Ustencil("Cuillère");
UstencilManager::insert($u);
$ustencils = UstencilManager::findAll();

$i = new Ingredient("Farine");
IngredientManager::insert($i);
$ingredients = IngredientManager::findAll();

$m = new Member("laure", "thomas", "thomaslaure3@gmail.com", "password");
MemberManager::insert($m);
$members = MemberManager::findAll();

$allergenIngredient = AllergenManager::findAllByIngredient($i);
//var_dump($allergenIngredient);


$r = new Recipe("gateau", "Je suis un gateau", "uneimage.png", 2, 5, 5, $m);
RecipeManager::insert($r);
$recipes = RecipeManager::findAll();

$s = new Step("Je suis un step", 1, $r);
//StepManager::insert($s);
$steps = StepManager::findAll();
//var_dump(StepManager::findAllByRecipe($r));
var_dump(RequirementManager::findAllByRecipe($r));

include(__DIR__ . "/../Views/home.php");