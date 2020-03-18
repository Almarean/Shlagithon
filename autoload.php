<?php

require_once __DIR__ . "/Models/Tag.php";
require_once __DIR__ . "/Models/Allergen.php";
require_once __DIR__ . "/Models/Requirement.php";
require_once __DIR__ . "/Models/Ingredient.php";
require_once __DIR__ . "/Models/Ustencil.php";
require_once __DIR__ . "/Models/Member.php";
require_once __DIR__ . "/Models/Recipe.php";
require_once __DIR__ . "/Models/Step.php";

require_once __DIR__ . "/Interfaces/IManager.php";

require_once __DIR__ . "/Services/PDOManager.php";
require_once __DIR__ . "/Services/TagManager.php";
require_once __DIR__ . "/Services/AllergenManager.php";
require_once __DIR__ . "/Services/RequirementManager.php";
require_once __DIR__ . "/Services/UstencilManager.php";
require_once __DIR__ . "/Services/RecipeManager.php";
require_once __DIR__ . "/Services/IngredientManager.php";
require_once __DIR__ . "/Services/StepManager.php";
require_once __DIR__ . "/Services/MemberManager.php";