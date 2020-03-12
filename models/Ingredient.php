<?php

namespace App\Models;

use App\Models\Allergen;
use App\Models\Requirement;

/**
 * Class Ingredient extends Requirement.
 */
class Ingredient extends Requirement
{
    /**
     * Allergens of the ingredient.
     *
     * @var array
     */
    private $allergens = [];

    /**
     * Constructor of the Ingredient class.
     *
     * @param string $label
     */
    public function __construct(string $label)
    {
        $this->label = ucwords($label);
        $this->$allergens = [];
    }

    /**
     * Getter of the allergens of the ingredient.
     *
     * @return array
     */
    public function getAllergens(): array
    {
        return $this->allergens;
    }

    /**
     * Add an allergen to the ingredient.
     *
     * @param Allergen $allergen
     *
     * @return array
     */
    public function addAllergen(Allergen $allergen): array
    {
        array_push($this->allergens, $allergen);
        return $this->allergens;
    }

    /**
     * Remove an allergen to the ingredient.
     *
     * @param Allergen $allergen
     *
     * @return array
     */
    public function removeAllergen(Allergen $allergen): array
    {
        if (in_array($allergen, $this->allergens)) {
            unset($allergen);
            return array_values($this->$allergens);
        } else {
            return $this->allergens;
        }
    }
}