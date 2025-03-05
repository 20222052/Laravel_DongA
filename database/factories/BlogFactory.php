<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class BlogFactory extends Factory
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
           'link' => 'fb.com',
           'position' => 'abcjdhkj', 
           'image' => 'uploads/product/h2_product01.png', 
           'description' => $this->faker->text(), 
           'status' => 1
        ];
    }
}
