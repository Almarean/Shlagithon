<?php

namespace App\Services;

use PDO;
use App\Interfaces\IManager;
use App\Models\Member;

/**
 * Class MemberManager implements IManager.
 */
class MemberManager implements IManager
{
    /**
     * Insert an member in database.
     *
     * @param Member $object
     *
     * @return boolean
     */
    public static function insert($object): bool
    {
        if (get_class($object) === "App\\Models\\Member") {
            if (self::exists($object->getEmail())) {
                return false;
            }
            $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO member(m_name, m_firstname, m_email, m_password, m_type, m_is_confirmed, m_creation_date, m_last_connection_date) VALUES (:name, :firstname, :email, :password, 'MEMBER', 0, :creationDate, :lastConnectionDate);");
            $stmt->bindValue(":name", $object->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":firstname", $object->getFirstname(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $object->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":password", $object->getPassword(), PDO::PARAM_STR);
            $stmt->bindValue(":creationDate", $object->getCreationDate(), PDO::PARAM_STR);
            $stmt->bindValue(":lastConnectionDate", $object->getLastConnectionDate(), PDO::PARAM_STR);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
 * Fetch all members in database.
 *
 * @return array
 */
    public static function findAll(): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->query("SELECT * FROM member;");
        $results = $stmt->fetchAll();
        $objects = [];
        foreach($results as $result) {
            $member = new Member($result["m_id"], $result["m_name"], $result["m_firstname"], $result["m_email"], $result["m_password"], $result["m_type"]);
            $member->setCreationDate($result["m_creation_date"]);
            if ($result["m_last_connection_date"] !== null) {
                $member->setLastConnectionDate($result["m_last_connection_date"]);
            }
            $member->setIsConfirmed($result["m_is_confirmed"]);
            $member->setFavoriteRecipes(RecipeManager::findFavoriteRecipes($member));
            $member->setWrittenRecipes(RecipeManager::findWrittenRecipes($member));
            array_push($objects, $member);
        }
        return $objects;
    }

    /**
     * Fetch all members in database by date creation.
     *
     * @return array
     */
    public static function findAllByDateCreation(): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->query("SELECT * FROM member order by m_creation_date asc;");
        $results = $stmt->fetchAll();
        $objects = [];
        foreach($results as $result) {
            $member = new Member($result["m_id"], $result["m_name"], $result["m_firstname"], $result["m_email"], $result["m_password"], $result["m_type"]);
            $member->setCreationDate($result["m_creation_date"]);
            if ($result["m_last_connection_date"] !== null) {
                $member->setLastConnectionDate($result["m_last_connection_date"]);
            }
            $member->setIsConfirmed($result["m_is_confirmed"]);
            $member->setFavoriteRecipes(RecipeManager::findFavoriteRecipes($member));
            $member->setWrittenRecipes(RecipeManager::findWrittenRecipes($member));
            array_push($objects, $member);
        }
        return $objects;
    }


    /**
     * Fetch a member.
     *
     * @param void $identifier
     *
     * @return Member|null
     */
    public static function findOneBy($identifier): ?Member
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM member WHERE m_email = :email;");
        $stmt->bindValue(":email", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($result) {
            $member = new Member($result["m_id"], $result["m_name"], $result["m_firstname"], $result["m_email"], $result["m_password"], $result["m_type"]);
            $member->setCreationDate($result["m_creation_date"]);
            if ($result["m_last_connection_date"] !== null) {
                $member->setLastConnectionDate($result["m_last_connection_date"]);
            }
            $member->setIsConfirmed($result["m_is_confirmed"]);
            $member->setFavoriteRecipes(RecipeManager::findFavoriteRecipes($member));
            //$member->setWrittenRecipes(RecipeManager::findWrittenRecipes($member));
            return $member;
        } else {
            return null;
        }
    }

    /**
     * Fetch a member.
     *
     * @param void $identifier
     * @param bool $convertIntoObject
     *
     * @return Member|array|null
     */
    public static function fetchOneBy($identifier, bool $convertIntoObject = true): ?Member
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM member WHERE m_email = :email;");
        $stmt->bindValue(":email", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        if (!$convertIntoObject) {
            return $result;
        }
        if ($result) {
            $member = new Member($result["m_id"], $result["m_name"], $result["m_firstname"], $result["m_email"], $result["m_password"], $result["m_type"]);
            $member->setCreationDate($result["m_creation_date"]);
            if ($result["m_last_connection_date"] !== null) {
                $member->setLastConnectionDate($result["m_last_connection_date"]);
            }
            $member->setIsConfirmed($result["m_is_confirmed"]);
            $member->setFavoriteRecipes(RecipeManager::findFavoriteRecipes($member));
            //$member->setWrittenRecipes(RecipeManager::findWrittenRecipes($member));
            return $member;
        } else {
            return null;
        }
    }

    /**
     * Fetch a member by his ID.
     *
     * @param int $identifier
     *
     * @return Member|null
     */
    public static function findOneByID(int $identifier): ?Member
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM member WHERE m_id = :id;");
        $stmt->bindValue(":id", $identifier, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $member = new Member($result["m_id"], $result["m_name"], $result["m_firstname"], $result["m_email"], $result["m_password"], $result["m_type"]);
            $member->setCreationDate($result["m_creation_date"]);
            if ($result["m_last_connection_date"] !== null) {
                $member->setLastConnectionDate($result["m_last_connection_date"]);
            }
            $member->setIsConfirmed($result["m_is_confirmed"]);
            $member->setFavoriteRecipes(RecipeManager::findFavoriteRecipes($member));
            //$member->setWrittenRecipes(RecipeManager::findWrittenRecipes($member));
            return $member;
        } else {
            return null;
        }
    }

    /**
     * Fetch the ID of the member.
     *
     * @param void $identifier
     *
     * @return integer|null
     */
    public static function findIdBy($identifier): ?int
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT m_id FROM member WHERE m_email = :email;");
        $stmt->bindValue(":email", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result["m_id"] : null;
    }

    /**
     * Delete a member by his ID.
     *
     * @param int $identifier
     *
     * @return void
     */
    public static function deleteOneById(int $identifier): void
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("DELETE FROM member WHERE m_id = :id;");
        $stmt->bindValue(":id", $identifier, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * Verify if the member exists.
     *
     * @param void $identifier
     *
     * @return boolean
     */
    public static function exists($identifier): bool
    {
        return self::findOneBy($identifier) ? true : false;
    }
}