<?php

namespace Models;

use Models\Recipe;

/**
 * Class Step.
 */
class Step
{
    /**
     * Description of the step.
     *
     * @var string
     */
    private $description;

    /**
     * Order of the step.
     *
     * @var int
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
     * @param string $description Description to set to the step.
     * @param integer $order Order to set to the step.
     * @param Recipe $recipe Recipe to set to the step.
     */
    public function __construct(string $description, int $order, Recipe $recipe)
    {
        $this->description = $description;
        $this->order = $order;
        $this->recipe = $recipe;
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
     * @param string $description Description to set to the step.
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
     * @param integer $order Order to set to the step.
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
     * @param Recipe $recipe Recipe to set to the step.
     * 
     * @return self
     */
    public function setRecipe(Recipe $recipe): self
    {
        $this->recipe = $recipe;
        return $this;
    }
}