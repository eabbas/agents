<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kit>
 */
class KitFactory extends Factory
{
    /**
     * Define the model's default state.
     *c
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product_count =  count(Product::all());

        return [
            'title' => 'کیت ' . $this->faker->word,
            'company_id' => rand(10000, 99999),
            'price' => rand(10000, 100000),
        ];
    }
}
