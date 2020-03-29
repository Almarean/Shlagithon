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
     * @param integer $id
     * @param string $label
     */
    public function __construct(int $id, string $label)
    {
        $this->id = $id;
        $this->label = ucfirst($label);
    }
}