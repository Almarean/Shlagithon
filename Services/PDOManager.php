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
     * @param string $env
     */
    private function __construct(string $host, string $username, string $password, string $env = "prod")
    {
        try {
            if ($env === "prod") {
                $dbname = "shlagithon";
            } else {
                $dbname = "shlagithon";
            }
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
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
                $host = "localhost"; // mysql-thomaslaure.alwaysdata.net
                $username = "root"; // 136984
                $password = "";
            }
            self::$_instance = new PDOManager($host, $username, $password, $env);
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

    /**
     * Find the last inserted ID in the table.
     *
     * @param string $table
     *
     * @return integer
     */
    public function getLastInsertId(string $table): int
    {
        $stmt = self::getInstance()->getPDO()->prepare("SELECT (auto_increment - 1) as lastId FROM information_schema.tables WHERE table_name = :table;");
        $stmt->bindValue(":table", $table, PDO::PARAM_STR);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result["lastId"] : 0;
    }
}