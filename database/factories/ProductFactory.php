<?php

namespace Database\Factories;

use App\Models\ProductModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = ProductModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_title' => $this->faker->name(),
            'product_desc'  => $this->faker->text(),
            'product_image' => "uploads/products/" . $this->faker->image(public_path("uploads/products"), 150, 150, null, false),
        ];
    }
}
