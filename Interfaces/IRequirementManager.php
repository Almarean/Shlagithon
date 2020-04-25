<?php

namespace App\Interfaces;

use App\Models\Recipe;

/**
 * Interface IRequirementManager.
 */
interface IRequirementManager
{
    public static function insert($object, Recipe $recipe): bool;

    public static function findAll(): array;

    public static function findOneBy($identifier, bool $convertIntoObject = true);

    public static function findIdBy($identifier): ?int;

    public static function exists($identifier): bool;

    public static function deleteOneById($identifier): bool;
}