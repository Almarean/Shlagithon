<?php

namespace App\Models;

use App\Models\Requirement;

/**
 * Class Ustencil extends Requirement.
 */
class Ustencil extends Requirement
{
    /**
     * Constructor of the Ustencil class.
     *
     * @param string $label
     */
    public function __construct(string $label)
    {
        $this->label = ucfirst($label);
    }
}