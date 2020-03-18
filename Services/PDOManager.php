<?php

namespace App\Services;

use PDO;
use PDOException;

/**
 * Class PDOManager.
 * Singleton
 */
class PDOManager
{
    /**
     * Instance of the PDOManager class.
     *
     * @var PDOManager
     */
    private static $_instance = null;

    /**
     * Instance of the PDO class.
     *
     * @var PDO
     */
    private $pdo = null;

    /**
     * Constructor of the PDOManager class.
     *
     * @param string $host
     * @param string $username
     * @param string $password
     */
    private function __construct(string $host, string $username, string $password)
    {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=shlagithon", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed : " . $e->getMessage();
        }
    }

    /**
     * Get the PDO instance.
     *
     * @return PDO|null
     */
    public function getPDO(): ?PDO
    {
        return $this->pdo;
    }

    /**
     * Get the instance of the PDOManager class.
     *
     * @param string $env
     *
     * @return PDOManager
     */
    public static function getInstance(string $env = "prod"): PDOManager
    {
        if (is_null(self::$_instance)) {
            $host = null;
            $username = null;
            $password = null;
            if ($env === "dev") {
                $host = "localhost";
                $username = "root";
                $password = "";
            } else {
                $host = "localhost";
                $username = "root";
                $password = "";
            }
            self::$_instance = new PDOManager($host, $username, $password);
        }
        return self::$_instance;
    }

    /**
     * Close the connection to the database.
     *
     * @return void
     */
    public function closeConnection(): void
    {
        if (self::$_instance !== null) {
            self::$_instance = null;
        }
    }
}