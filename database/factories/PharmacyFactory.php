<?php

namespace Database\Factories;

use App\Models\PharmacyModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PharmacyFactory extends Factory
{
    protected $model = PharmacyModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pharmacy_name'    => $this->faker->name(),
            'pharmacy_address' => $this->faker->address(),
        ];
    }

}
