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
}