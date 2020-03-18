<?php

namespace App\Interfaces;

/**
 * Interface IManager.
 */
interface IManager
{
    public static function insert($object): bool;

    public static function findAll(): array;

    public static function findOneBy($identifier, bool $convertIntoObject = true);

    public static function findIdBy($identifier): ?int;

    public static function exists($identifier): bool;
}