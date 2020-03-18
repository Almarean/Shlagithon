<?php

namespace Models;

use Models\Member;
use Models\Tag;
use Models\Requirement;

/**
 * Class Recipe.
 */
class Recipe
{
    /**
     * Name of the recipe.
     *
     * @var string
     */
    private $name;

    /**
     * Description of the recipe.
     *
     * @var string
     */
    private $description;

    /**
     * Image of the recipe.
     *
     * @var string
     */
    private $image;

    /**
     * Difficulty of the recipe.
     *
     * @var int
     */
    private $difficulty;

    /**
     * Time to make the recipe in minutes.
     *
     * @var int
     */
    private $time;

    /**
     * Number of persons of the recipe.
     *
     * @var int
     */
    private $nbPersons;

    /**
     * Advice of the recipe.
     *
     * @var string
     */
    private $advice;

    /**
     * Tags of the recipe.
     *
     * @var array
     */
    private $tags;

    /**
     * Requirements of the recipe.
     *
     * @var array
     */
    private $requirements;

    /**
     * Member who writes the recipe.
     *
     * @var Member
     */
    private $author;

    /**
     * Constructor of the Recipe class.
     *
     * @param string $name Name to set to the recipe.
     * @param string $description Description to set to the recipe.
     * @param string $image Image to set to the recipe.
     * @param integer $difficulty Difficulty to set to the recipe.
     * @param integer $time Time to set to the recipe.
     * @param integer $nbPersons Number of persons to set to the recipe.
     * @param string $advice Advice to set to the recipe.
     * @param Member $author Member to set to the recipe.
     */
    public function __construct(string $name, string $description, string $image, int $difficulty, int $time, int $nbPersons, string $advice, Member $author)
    {
        $this->name = ucfirst($name);
        $this->description = $description;
        $this->image = $image;
        $this->difficulty = $difficulty;
        $this->time = $time;
        $this->nbPersons = $nbPersons;
        $this->advice = $advice;
        $this->tag = [];
        $this->requirements = [];
        $this->author = $author;
    }

    /**
     * Getter of the name of the recipe.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Setter of the name of the recipe/
     *
     * @param string $name Name to set to the recipe.
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = ucfirst($name);
        return $this;
    }

    /**
     * Getter of the description of the recipe.
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Setter of the description of the recipe.
     *
     * @param string $description Description to set to the recipe.
     *
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Gette of the image of the recipe.
     *
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * Setter of the image of the recipe.
     *
     * @param string $image Image to set to the recipe.
     *
     * @return self
     */
    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * Getter of the difficulty of the recipe.
     *
     * @return integer
     */
    public function getDifficulty(): int
    {
        return $this->difficulty;
    }

    /**
     * Setter of the difficulty of the recipe.
     *
     * @param integer $difficulty Diificulty to set to the recipe.
     *
     * @return self
     */
    public function setDifficulty(int $difficulty): self
    {
        $this->difficulty = $difficulty;
        return $this;
    }

    /**
     * Getter of the time of the recipe.
     *
     * @return integer
     */
    public function getTime(): int
    {
        return $this->time;
    }

    /**
     * Setter of the time of the recipe.
     *
     * @param integer $time Time to set to the recipe.
     *
     * @return self
     */
    public function setTime(int $time): self
    {
        $this->time = $time;
        return $this;
    }

    /**
     * Getter of the number of persons of the recipe.
     *
     * @return integer
     */
    public function getNbPersons(): int
    {
        return $this->nbPersons;
    }

    /**
     * Setter of the number of persons of the recipe.
     *
     * @param integer $nbPersons Number of persons to set to the recipe.
     *
     * @return self
     */
    public function setNbPersons(int $nbPersons): self
    {
        $this->nbPersons = $nbPersons;
        return $this;
    }

    /**
     * Getter of the advice of the recipe.
     *
     * @return string|null
     */
    public function getAdvice(): ?string
    {
        return $this->advice();
    }

    /**
     * Setter of the advice of the recipe.
     *
     * @param string $advice Advice to set to the recipe.
     *
     * @return self
     */
    public function setAdvice(string $advice): self
    {
        $this->advice = $advice;
        return $this;
    }

    /**
     * Getter of the tags of the recipe.
     *
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * Add a tag to the recipe.
     *
     * @param Tag $tag Tag to add to the recipe.
     *
     * @return array
     */
    public function addTag(Tag $tag): array
    {
        array_push($this->tags, $tag);
        return $this->tags;
    }

    /**
     * Remove a tag from the recipe.
     *
     * @param Tag $tag Tag to remove from the recipe.
     *
     * @return array
     */
    public function removeTag(Tag $tag): array
    {
        if (in_array($tag, $this->tags)) {
            unset($tag);
            return array_values($this->tags);
        } else {
            return $this->tags;
        }
    }

    /**
     * Getter of the requirements of the recipe.
     *
     * @return array
     */
    public function getRequirements(): array
    {
        return $this->requirements;
    }

    /**
     * Add a requirement to the recipe.
     *
     * @param Requirement $requirement Requirement to add to the recipe.
     *
     * @return array
     */
    public function addRequirement(Requirement $requirement): array
    {
        array_push($this->requirements, $requirement);
    }

    /**
     * Remove a requirement from the recipe.
     *
     * @param Requirement $requirement Requirement to remove from the recipe.
     *
     * @return array
     */
    public function removeRequirement(Requirement $requirement): array
    {
        if (in_array($requirement, $this->requirements)) {
            unset($requirement);
            return array_values($this->requirements);
        } else {
            return $this->requirements;
        }
    }

    /**
     * Getter of the author of the recipe.
     *
     * @return Member
     */
    public function getAuthor(): Member
    {
        return $this->author;
    }

    /**
     * Setter of the author of the recipe.
     *
     * @param Member $author Member to set to the recipe.
     *
     * @return self
     */
    public function setAuthor(Member $author): self
    {
        $this->author = $author;
        return $this;
    }
}