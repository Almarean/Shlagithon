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
            $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO member(m_name, m_firstname, m_email, m_password, m_type, m_is_confirmed, m_is_deleted, m_creation_date, m_last_connection_date) VALUES (:name, :firstname, :email, :password, 'MEMBER', 0, 0, :creationDate, :lastConnectionDate);");
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
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            $member = new Member($result["m_id"], $result["m_name"], $result["m_firstname"], $result["m_email"], $result["m_password"], $result["m_type"], $result["m_is_confirmed"], $result["m_is_deleted"]);
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
        $stmt = PDOManager::getInstance()->getPDO()->query("SELECT * FROM member ORDER BY m_creation_date ASC;");
        $results = $stmt->fetchAll();
        $objects = [];
        foreach ($results as $result) {
            $member = new Member($result["m_id"], $result["m_name"], $result["m_firstname"], $result["m_email"], $result["m_password"], $result["m_type"], $result["m_is_confirmed"], $result["m_is_deleted"]);
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
     * @param bool $convertIntoObject
     *
     * @return Member|null|array
     */
    public static function findOneBy($identifier, bool $convertIntoObject = true)
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM member WHERE m_email = :email AND m_is_deleted = 0;");
        $stmt->bindValue(":email", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$convertIntoObject) {
            return $result;
        }
        if ($result) {
            $member = new Member($result["m_id"], $result["m_name"], $result["m_firstname"], $result["m_email"], $result["m_password"], $result["m_type"], $result["m_is_confirmed"], $result["m_is_deleted"]);
            $member->setCreationDate($result["m_creation_date"]);
            if ($result["m_last_connection_date"] !== null) {
                $member->setLastConnectionDate($result["m_last_connection_date"]);
            }
            $member->setIsConfirmed($result["m_is_confirmed"]);
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
    public static function findOneByID(int $identifier, bool $isDeleted = false): ?Member
    {
        if ($isDeleted) {
            $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM member WHERE m_id = :id AND m_is_deleted = 0;");
        } else {
            $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM member WHERE m_id = :id;");
        }
        $stmt->bindValue(":id", $identifier, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $member = new Member($result["m_id"], $result["m_name"], $result["m_firstname"], $result["m_email"], $result["m_password"], $result["m_type"], $result["m_is_confirmed"], $result["m_is_deleted"]);
            $member->setCreationDate($result["m_creation_date"]);
            if ($result["m_last_connection_date"] !== null) {
                $member->setLastConnectionDate($result["m_last_connection_date"]);
            }
            $member->setIsConfirmed($result["m_is_confirmed"]);
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
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT m_id FROM member WHERE m_email = :email AND m_is_deleted = 0;");
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
     * @return bool
     */
    public static function deleteOneById(int $identifier): bool
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("DELETE FROM member WHERE m_id = :id;");
        $stmt->bindValue(":id", $identifier, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Change the state of confirmation of the member.
     *
     * @param integer $identifier
     * @param boolean $delete
     *
     * @return boolean
     */
    public static function changeDeletionOneById(int $identifier, bool $delete = true): bool
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("UPDATE member SET m_is_deleted = :delete WHERE m_id = :id;");
        $stmt->bindValue(":delete", $delete, PDO::PARAM_BOOL);
        $stmt->bindValue(":id", $identifier, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Update a member.
     *
     * @param int $identifier
     * @param string $name
     * @param string $firstname
     * @param string $email
     * @param string $type
     * @param string $password
     *
     * @return bool
     */
    public static function updateMember(int $identifier, string $name, string $firstname, string $email, string $type, string $password = null): bool
    {
        if ($password) {
            $stmt = PDOManager::getInstance()->getPDO()->prepare("UPDATE member SET m_name = :name, m_firstname = :firstname, m_email = :email, m_type = :type, m_password = :password WHERE m_id = :id;");
            $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        } else {
            $stmt = PDOManager::getInstance()->getPDO()->prepare("UPDATE member SET m_name = :name, m_firstname = :firstname, m_email = :email, m_type = :type WHERE m_id = :id;");
        }
        $stmt->bindValue(":id", $identifier, PDO::PARAM_INT);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":firstname", $firstname, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":type", $type, PDO::PARAM_STR);
        return $stmt->execute();
    }

    /**
     * Update the last connection date of the given member.
     *
     * @param integer $identifier
     *
     * @return boolean
     */
    public static function updateLastConnectionDate(int $identifier): bool
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("UPDATE member SET m_last_connection_date = :lastConnectionDate WHERE m_id = :id;");
        $stmt->bindValue(":lastConnectionDate", date("Y-m-d H:i:s"), PDO::PARAM_STR);
        $stmt->bindValue(":id", $identifier, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Update the state of confirmation of a member.
     *
     * @param string $email
     * @param boolean $confirmation
     *
     * @return boolean
     */
    public static function updateMemberConfirmation(string $email, bool $confirmation): bool
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("UPDATE member SET m_is_confirmed = :isConfirmed WHERE m_email = :email AND m_is_deleted = 0;");
        $stmt->bindValue(":isConfirmed", $confirmation, PDO::PARAM_BOOL);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        return $stmt->execute();
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