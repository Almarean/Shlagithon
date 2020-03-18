<?php

namespace App\Models;

use App\Models\Recipe;

/**
 * Class Step.
 */
class Step
{
    /**
     * ID of the step.
     *
     * @var integer
     */
    private $id;

    /**
     * Description of the step.
     *
     * @var string
     */
    private $description;

    /**
     * Order of the step.
     *
     * @var integer
     */
    private $order;

    /**
     * Recipe to which the step belongs.
     *
     * @var Recipe
     */
    private $recipe;

    /**
     * Constructor of the Step class.
     *
     * @param string $description
     * @param integer $order
     * @param Recipe $recipe
     */
    public function __construct(string $description, int $order, Recipe $recipe)
    {
        $this->description = $description;
        $this->order = $order;
        $this->recipe = $recipe;
    }

    /**
     * Getter of the ID of the step.
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter of the description of the step
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Setter of the description of the step.
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
     * Getter of the order of the step.
     *
     * @return integer
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * Setter of the order of the step
     *
     * @param integer $order
     *
     * @return self
     */
    public function setOrder(int $order): self
    {
        $this->order = $order;
        return $this;
    }

    /**
     * Getter of the recipe of the step.
     *
     * @return Recipe
     */
    public function getRecipe(): Recipe
    {
        return $this->recipe;
    }

    /**
     * Setter of the recipe of the step.
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