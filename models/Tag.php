<?php

namespace App\Models;

/**
 * Class Tag;
 */
class Tag
{
    /**
     * ID of the tag.
     *
     * @var integer
     */
    private $id;

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
     * Getter of the ID of the tag.
     *
     * @return integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @param string $label
     *
     * @return self
     */
    public function setLabel(string $label): self
    {
        $this->label = ucfirst($label);
        return $this;
    }
}