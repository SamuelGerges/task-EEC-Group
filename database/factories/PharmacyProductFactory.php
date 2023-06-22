<?php

namespace Database\Factories;

use App\Models\PharmacyProductModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PharmacyProductFactory extends Factory
{
    protected $model = PharmacyProductModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id'       => $this->faker->numberBetween(1, 10000),
            'pharmacy_id'      => $this->faker->numberBetween(1, 5000),
            'product_quantity' => $this->faker->numberBetween(1, 20),
            'product_price'    => $this->faker->randomFloat(2, 15, 100),
        ];
    }
}
