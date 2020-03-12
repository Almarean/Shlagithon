<?php

namespace App\Interfaces;

use PDO;

/**
 * Interface IManager.
 */
interface IManager
{
    public static function insert($object, ?PDO $connection = null, bool $closeConnection = true): bool;

    public static function fetchAll(?PDO $connection = null, bool $closeConnection = true): array;

    public static function fetchOneBy(string $identifier, ?PDO $connection = null, bool $closeConnection = true);

    public static function fetchIdBy(string $identifier, ?PDO $connection = null, bool $closeConnection = true): ?int;

    public static function exists(string $identifier, ?PDO $connection = null, bool $closeConnection = true): bool;
}