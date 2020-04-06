<?php

namespace App\Models;

/**
 * Class Comment.
 */
class Comment
{
    /**
     * ID of the comment.
     *
     * @var integer
     */
    private $id;

    /**
     * Text of the comment.
     *
     * @var string
     */
    private $text;

    /**
     * Writing date of the comment.
     *
     * @var string
     */
    private $writingDate;

    /**
     * Author of the comment.
     *
     * @var Member
     */
    private $author;

    /**
     * Recipe of the comment.
     *
     * @var Recipe
     */
    private $recipe;

    /**
     * Constructor of the Comment class.
     *
     * @param integer $id
     * @param string $text
     * @param Member $author
     * @param Recipe $recipe
     */
    public function __construct(int $id, string $text, Member $author, Recipe $recipe)
    {
        $this->id = $id;
        $this->text = $text;
        $this->writingDate = date("Y-m-d h:i:s");
        $this->author = $author;
        $this->recipe = $recipe;
    }

    /**
     * Getter of the ID of the comment.
     *
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Getter of the text of the comment.
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Setter of the text of the comment.
     *
     * @param string $text
     *
     * @return self
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Getter of the writing date of the comment.
     *
     * @return string
     */
    public function getWritingDate(): string
    {
        return $this->writingDate;
    }

    /**
     * getter of the author of the comment.
     *
     * @return Member
     */
    public function getAuthor(): Member
    {
        return $this->author;
    }

    /**
     * Setter of the author of the comment.
     *
     * @param Member $author
     *
     * @return self
     */
    public function setAuthor(Member $author): self
    {
        $this->author = $author;
        return $this;
    }

    /**
     * Getter of the recipe of the comment.
     *
     * @return Recipe
     */
    public function getRecipe(): Recipe
    {
        return $this->recipe;
    }

    /**
     * Setter of the recipe of the comment.
     *
     * @param Recipe $recipe
     *
     * @return self
     */
    public function setRecipe(Recipe $recipe): self
    {
        $this->recipe = $recipe;
        return $this;
    }
}