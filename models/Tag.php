<?php

namespace Models;

/**
 * Class Tag;
 */
class Tag
{
    /**
     * Label of the tag.
     *
     * @var string
     */
    private $label;

    /**
     * Constructor of the Tag class.
     *
     * @param string $label
     */
    public function __construct(string $label)
    {
        $this->label = ucfirst($label);
    }

    /**
     * Getter of the label of the tag.
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Setter of the label of the tag.
     *
     * @param string $label Label to set to the tag.
     *
     * @return self
     */
    public function setLabel(string $label): self
    {
        $this->label = ucfirst($label);
        return $this;
    }
}