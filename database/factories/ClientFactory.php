<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $rand = rand(1000,10000000);
        return [
            'type' => ['legal', 'real'][rand(0,1)],
            'name' => $this->faker->name(),
            'family' => $this->faker->name(),
            'submit_number' => $rand,
            'full_name' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'birth' => $this->faker->date('Y-m-d' , 'now'),
            'father_name' => $this->faker->name(),
            'province' => $this->faker->city(),
            'city' => $this->faker->city(),
            'job' => $this->faker->title(),
            'agent_username' =>  $rand,
            'agent_id' => 3 ,
        ];
    }
}
