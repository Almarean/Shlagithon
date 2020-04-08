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
     * @param string $quantity
     */
    public function __construct(int $id, string $label, string $quantity)
    {
        $this->id = $id;
        $this->label = ucfirst($label);
        $this->quantity = $quantity;
    }
}