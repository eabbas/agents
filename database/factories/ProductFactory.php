<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use function Spatie\Ignition\ErrorPage\title;

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
    public function definition()
    {
        return [
            'title' => 'محصول ' .  $this->faker->word,
            'price' => rand(100000, 1000000),
            'company_id' => rand(10000, 99999),
            'description' => $this->faker->sentence,
        ];
    }
}
