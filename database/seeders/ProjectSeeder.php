<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::factory()->count(10)->create()->each(function($project) {
            $user_ids = User::inRandomOrder()->limit(3)->pluck('id');
            $project->users()->attach($user_ids);
        });
    }
}
