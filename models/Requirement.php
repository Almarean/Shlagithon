<?php

namespace App\Models;

/**
 * Abstract class Requirement
 */
abstract class Requirement
{
    /**
     * ID of the requirement.
     *
     * @var integer
     */
    protected $id;

    /**
     * Label of the requirement.
     *
     * @var string
     */
    protected $label;

    /**
     * Quantity of the requirement for the recipe.
     *
     * @var string
     */
    protected $quantity;

    /**
     * Getter of the ID of the requirement.
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter of the label of the requirement.
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Setter of the label of the requirement.
     *
     * @param string $label Label to set to the requirement.
     *
     * @return self
     */
    public function setLabel(string $label): self
    {
        $this->label = ucfirst($label);
        return $this;
    }

    /**
     * Getter of the quantity of the requirement for the recipe.
     *
     * @return string
     */
    public function getQuantity(): string
    {
        return $this->quantity;
    }

    /**
     * Setter of the quantity of the requirement for the recipe.
     *
     * @param string $quantity
     *
     * @return self
     */
    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }
}