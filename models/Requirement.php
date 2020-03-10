<?php

namespace Models;

/**
 * Abstract class Requirement
 */
abstract class Requirement
{
    /**
     * Label of the requirement.
     *
     * @var string
     */
    protected $label;

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