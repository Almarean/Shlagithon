<?php

namespace App\Models;

use App\Models\Member;
use App\Models\Tag;
use App\Models\Requirement;

/**
 * Class Recipe.
 */
class Recipe
{
    /**
     * ID of the recipe
     *
     * @var integer
     */
    private $id;

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
     * @var integer
     */
    private $difficulty;

    /**
     * Time to make the recipe in minutes.
     *
     * @var integer
     */
    private $time;

    /**
     * Number of persons of the recipe.
     *
     * @var integer
     */
    private $nbPersons;

    /**
     * Advice of the recipe.
     *
     * @var string
     */
    private $advice;

    /**
     * Type of the recipe.
     *
     * @var string
     */
    private $type;

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
     * Steps of the recipe.
     *
     * @var array
     */
    private $steps;

    /**
     * Constructor of the Recipe class.
     *
     * @param string $name
     * @param string $description
     * @param string $image
     * @param integer $difficulty
     * @param integer $time
     * @param integer $nbPersons
     * @param Member $author
     * @param string $type
     * @param string|null $advice
     */
    public function __construct(int $id, string $name, string $description, string $image, int $difficulty, int $time, int $nbPersons, Member $author, string $type, string $advice = null)
    {
        $this->id = $id;
        $this->name = ucfirst($name);
        $this->description = $description;
        $this->image = $image;
        $this->difficulty = $difficulty;
        $this->time = $time;
        $this->nbPersons = $nbPersons;
        $this->advice = $advice;
        $this->type = $type;
        $this->tags = [];
        $this->requirements = [];
        $this->author = $author;
        $this->steps = [];
    }

    /**
     * Getter of the ID of the recipe.
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @param string $name
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
     * @param string $description
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
     * @param string $image
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
     * @param integer $difficulty
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
     * @param integer $time
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
     * @param integer $nbPersons
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
        return $this->advice;
    }

    /**
     * Setter of the advice of the recipe.
     *
     * @param string $advice
     *
     * @return self
     */
    public function setAdvice(string $advice): self
    {
        $this->advice = $advice;
        return $this;
    }

    /**
     * Getter of the type of the recipe.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Setter of the type of the recipe.
     *
     * @param string $type
     *
     * @return self
     */
    public function setType(string $type): self
    {
        $this->type = $type;
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
     * Setter of the tags of the recipe.
     *
     * @param array $tags
     *
     * @return $this
     */
    public function setTags(array $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * Add a tag to the recipe.
     *
     * @param Tag $tag
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
     * @param Tag $tag
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
     * Setter of the requirements of the recipe.
     *
     * @param array $requirements
     *
     * @return $this
     */
    public function setRequirements(array $requirements): self
    {
        $this->requirements = $requirements;
        return $this;
    }

    /**
     * Add a requirement to the recipe.
     *
     * @param Requirement $requirement
     *
     * @return array
     */
    public function addRequirement(Requirement $requirement): array
    {
        array_push($this->requirements, $requirement);
        return $this->requirements;
    }

    /**
     * Remove a requirement from the recipe.
     *
     * @param Requirement $requirement
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
     * Getter of the steps of the recipe.
     *
     * @return array
     */
    public function getSteps(): array
    {
        return $this->steps;
    }

    /**
     * Setter of the steps of the recipe.
     *
     * @param array $steps
     *
     * @return $this
     */
    public function setSteps(array $steps): self
    {
        $this->steps = $steps;
        return $this;
    }

    /**
     * Add a step to the recipe.
     *
     * @param Step $step
     *
     * @return array
     */
    public function addStep(Step $step): array
    {
        array_push($this->steps, $step);
        return $this->steps;
    }

    /**
     * Remove a step from the recipe.
     *
     * @param Step $step
     *
     * @return array
     */
    public function removeStep(Step $step): array
    {
        if (in_array($step, $this->steps)) {
            unset($step);
            return array_values($this->steps);
        } else {
            return $this->steps;
        }
    }
}