<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $project = Project::inRandomOrder()->first();
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(),
            'user_id' => $this->faker->randomElement($project->users->pluck('id')),
            'project_id' => $project->id,
        ];
    }
}
