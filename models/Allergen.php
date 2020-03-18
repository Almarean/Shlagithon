<?php

namespace Models;

/**
 * Class Allergen.
 */
class Allergen
{
    /**
     * Label of the allergen.
     *
     * @var string
     */
    private $label;

    /**
     * Constructor of the Allergen class.
     *
     * @param string $label Label to set to the allergen.
     */
    public function __construct(string $label)
    {
        $this->label = ucfirst($label);
    }

    /**
     * Getter of the label of the allergen.
     *
     * @return String
     */
    public function getLabel(): String
    {
        return $this->label;
    }

    /**
     * Setter of the label of the allergen.
     *
     * @param string $label Label to set to the allergen.
     *
     * @return self
     */
    public function setLabel(string $label): self
    {
        $this->label = ucfirst($label);
        return this;
    }
}