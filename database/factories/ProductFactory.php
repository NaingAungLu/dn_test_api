<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'category_id' => ProductCategory::factory(),
            'image' => 'products/images/' . $this->faker->uuid() . '.png',
        ];
    }
}
