<?php

namespace App\Services;

use PDO;
use App\Models\Comment;
use App\Models\Recipe;

/**
 * Class CommentManager.
 */
class CommentManager
{
    /**
     * Insert a comment in database.
     *
     * @param Comment $object
     * @return boolean
     */
    public static function insert($object): bool
    {
        if (get_class($object) == "App\\Models\\Comment") {
            $stmt = PDOManager::getInstance()->getPDO()->prepare("INSERT INTO comment(c_text, c_fk_member_id, c_fk_recipe_id) VALUES (:text, :memberId, :recipeId);");
            $stmt->bindValue(":text", $object->getText(), PDO::PARAM_STR);
            $stmt->bindValue(":memberId", $object->getAuthor()->getId(), PDO::PARAM_INT);
            $stmt->bindValue(":recipeId", $object->getRecipe()->getId(), PDO::PARAM_INT);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Find all the comments of the given recipe.
     *
     * @param Recipe $recipe
     *
     * @return array
     */
    public static function findByRecipe(Recipe $recipe): array
    {
        $stmt = PDOManager::getInstance()->getPDO()->prepare("SELECT * FROM comment WHERE c_recipe = :recipe;");
        $stmt->bindValue(":recipe", $recipe->getId(), PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($results as $result) {
            array_push($objects, new Comment($result["c_id"], $result["c_text"], MemberManager::findOneByID($result["rec_fk_member_id"]), RecipeManager::findOneById($result["c_fk_recipe_id"])));
        }
        return $objects;
    }
}