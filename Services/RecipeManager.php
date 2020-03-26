<?php

namespace App\Services;

use PDO;
use App\Interfaces\IManager;
use App\Models\Member;
use App\Models\Recipe;

/**
 * Class RecipeManager implements IManager;
 */
class RecipeManager implements IManager
{
    /**
     * Insert a recipe in database. TODO
     *
     * @param Recipe $object
     *
     * @return boolean
     */
    public static function insert($object): bool
    {
        if (get_class($object) === "App\\Models\\Recipe") {
            if (self::exists($object->getName())) {
                return false;
            }
            if (!$object->getAdvice()) {
                $query = "INSERT INTO recipe(rec_name, rec_description, rec_image, rec_difficulty, rec_time, rec_nb_persons, rec_type rec_fk_member_id) VALUES (:name, :description, :image, :difficulty, :time, :nbPersons, :type, :memberId);";
            } else {
                $query = "INSERT INTO recipe(rec_name, rec_description, rec_image, rec_difficulty, rec_time, rec_nb_persons, rec_advice, rec_type, rec_fk_member_id) VALUES (:name, :description, :image, :difficulty, :time, :nbPersons, :advice, :type, :memberId);";
            }
            $stmt = PDOManager::getInstance()->getPDO()->prepare($query);
            $stmt->bindValue(":name", $object->getName(), PDO::PARAM_STR);
            $stmt->bindValue(":description", $object->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(":image", $object->getImage(), PDO::PARAM_STR);
            $stmt->bindValue(":difficulty", $object->getDifficulty(), PDO::PARAM_INT);
            $stmt->bindValue(":time", $object->getTime(), PDO::PARAM_INT);
            $stmt->bindValue(":nbPersons", $object->getNbPersons(), PDO::PARAM_INT);
            if ($object->getAdvice()) {
                $stmt->bindValue(":advice", $object->getAdvice(), PDO::PARAM_STR);
            }
            $stmt->bindValue(":type", $object->getType(), PDO::PARAM_STR);
            $stmt->bindValue(":memberId", MemberManager::findIdBy($object->getAuthor()->getEmail()), PDO::PARAM_INT);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Fetch all recipes in database.
     *
     * @return array
     */
    public static function findAll(): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->query("SELECT * FROM recipe;");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            $author = MemberManager::findOneByID($result["rec_fk_member_id"]);
            $recipe = new Recipe($result["rec_id"], $result["rec_name"], $result["rec_description"], $result["rec_image"], $result["rec_difficulty"], $result["rec_time"], $result["rec_nb_persons"], $author, $result["rec_advice"], $result["rec_type"]);
            $recipe->setTags(TagManager::findAllByRecipe($recipe));
            array_push($objects, $recipe);
        }
        return $objects;
    }

    /**
     * Fetch a tag.
     *
     * @param void $identifier
     * @param bool $convertIntoObject
     *
     * @return Recipe|null|array
     */
    public static function findOneBy($identifier, bool $convertIntoObject = true)
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM recipe WHERE rec_name = :name;");
        $stmt->bindValue(":name", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$convertIntoObject) {
            return $result;
        }
        return $result ? new Recipe($result["rec_id"], $result["rec_name"], $result["rec_description"], $result["rec_image"], $result["rec_difficulty"], $result["rec_time"], $result["rec_nb_persons"], MemberManager::findOneByID($result["rec_fk_member_id"]), $result["rec_advice"], $result["rec_type"]) : null;
    }

    /**
     * Fetch a recipe by an ID.
     *
     * @param int $id
     *
     * @return Recipe|null
     */
    public static function findOneById(int $id): ?Recipe
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM recipe WHERE rec_id = :recipeId;");
        $stmt->bindValue(":recipeId", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? new Recipe($result["rec_id"], $result["rec_name"], $result["rec_description"], $result["rec_image"], $result["rec_difficulty"], $result["rec_time"], $result["rec_nb_persons"], MemberManager::findOneByID($result["rec_fk_member_id"]), $result["rec_advice"], $result["rec_type"]) : null;
    }

    /**
     * Fetch the ID of the recipe.
     *
     * @param void $identifier
     *
     * @return integer|null
     */
    public static function findIdBy($identifier): ?int
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT rec_id FROM recipe WHERE rec_name = :name;");
        $stmt->bindValue(":name", $identifier, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result["rec_id"] : null;
    }

    /**
     * Verify if the tag exists.
     *
     * @param void $identifier
     *
     * @return boolean
     */
    public static function exists($identifier): bool
    {
        return self::findOneBy($identifier) ? true : false;
    }

    /**
     * Fetch written recipes by the member.
     *
     * @param Member $member
     *
     * @return array
     */
    public static function findWrittenRecipes(Member $member): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM recipe INNER JOIN member ON member.m_id = recipe.rec_fk_member_id WHERE rec_fk_member_id = :memberId;");
        $stmt->bindValue(":memberId", MemberManager::findIdBy($member->getEmail()), PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            array_push($objects, new Recipe($result["rec_id"], $result["rec_name"], $result["rec_description"], $result["rec_image"], $result["rec_difficulty"], $result["rec_time"], $result["rec_nb_persons"], MemberManager::findOneByID($result["rec_fk_member_id"]), $result["rec_advice"], $result["rec_type"]));
        }
        return $objects;
    }

    /**
     * fetch favorite recipes by member.
     *
     * @param Member $member
     *
     * @return array
     */
    public static function findFavoriteRecipes(Member $member): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM recipe INNER JOIN recipe_member ON recipe.rec_id = recipe_member.rm_fk_recipe_id WHERE rm_fk_member_id = :memberId;");
        $stmt->bindValue(":memberId", MemberManager::findIdBy($member->getEmail()), PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            array_push($objects, new Recipe($result["rec_id"], $result["rec_name"], $result["rec_description"], $result["rec_image"], $result["rec_difficulty"], $result["rec_time"], $result["rec_nb_persons"], MemberManager::findOneByID($result["rec_fk_member_id"]), $result["rec_advice"], $result["rec_type"]));
        }
        return $objects;
    }

    /**
     * Delete a recipe by his ID.
     *
     * @param int $identifier
     *
     * @return bool
     */
    public static function deleteOneById(int $identifier): bool
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("DELETE FROM recipe WHERE rec_id = :id;");
        $stmt->bindValue(":id", $identifier, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Update a recipe by his ID.
     *
     * @param int $identifier
     * @param string $name
     * @param string $description
     * @param string $image
     * @param int $difficulty
     * @param int $time
     * @param int $nbPersons
     * @param string $advice
     * @param string $type
     *
     * @return bool
     */
    public static function updateRecipe(int $identifier, string $name, string $description, string $image, int $difficulty, int $time, int $nbPersons, string $advice, string $type): bool
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("UPDATE recipe SET rec_name = :name, rec_description = :description, rec_image = :image, rec_difficulty = :difficulty, rec_time = :timeToCook, rec_nb_persons = :nbPersons, rec_advice = :advice, rec_type = :type WHERE rec_id = :id;");
        $stmt->bindValue(":id", $identifier, PDO::PARAM_INT);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->bindValue(":image", $image, PDO::PARAM_LOB);
        $stmt->bindValue(":difficulty", $difficulty, PDO::PARAM_INT);
        $stmt->bindValue(":timeToCook", $time, PDO::PARAM_INT);
        $stmt->bindValue(":nbPersons", $nbPersons, PDO::PARAM_INT);
        $stmt->bindValue(":advice", $advice, PDO::PARAM_STR);
        $stmt->bindValue(":type", $type, PDO::PARAM_STR);
        return $stmt->execute();
    }
}