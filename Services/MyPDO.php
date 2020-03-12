<?php

namespace App\Services;

use PDO;

/**
 * Class MyPDO.
 */
class MyPDO
{
    /**
     * Instanciate a connection to the database.
     *
     * @param string $env
     *
     * @return PDO
     */
    private static function getConnection(string $env = "dev"): PDO
    {
        $host = null;
        $username = null;
        $password = null;
        if ($env === "dev") {
            $host = "localhost";
            $username = "root";
            $password = "";
        } else if ($env === "prod") {
            $host = "localhost";
            $username = "root";
            $password = "";
        }
        try {
            $connection = new PDO("mysql:host=$host;dbname=shlagithon", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
            return $connection;
        } catch (PDOException $e) {
            echo "Connection failed : " . $e->getMessage();
        }
    }

    /**
     * Open a connection with the database.
     *
     * @param PDO|null $connection
     *
     * @return PDO|null
     */
    protected static function openConnection(?PDO $connection = null): ?PDO
    {
        if (!$connection) {
            $connection = self::getConnection();
        }
        return $connection;
    }

    /**
     * Close the connection with the database.
     *
     * @param PDO|null $connection
     * @param boolean $closeConnection
     *
     * @return void
     */
    protected static function closeConnection(?PDO $connection = null, bool $closeConnection = true): void
    {
        if ($closeConnection && $connection != null) {
            $connection = null;
        }
    }
}