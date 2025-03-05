<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'name' => $this->faker->name(), 
           'price' => 50000,
           'sale_price' => 25000, 
           'image' => 'uploads/product/h2_product01.png', 
           'category_id' => 1,
           'description' => $this->faker->text(), 
           'status' => 1
        ];
    }
}
