<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Client;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->words(10),
            'status' => $this->faker->randomElement([1,2,3]),
            'client_id' => $this->faker->randomElement(Client::pluck('id')),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
            'deadline' => $this->faker->dateTimeBetween('+1 year', now())
        ];
    }
}
