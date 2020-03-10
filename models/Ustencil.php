<?php

namespace Models;

use Models\Requirement;

/**
 * Class Ustencil extends Requirement.
 */
class Ustencil extends Requirement
{
    /**
     * Constructor of the Ustencil class.
     *
     * @param string $label Label to set to the Ustencil.
     */
    public function __construct(string $label)
    {
        $this->label = $label;
    }
}