<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Tag::all()->isEmpty()) {
            Tag::create([
                'title' => 'High priority'
            ]);

            Tag::create([
                'title' => 'Design'
            ]);

            Tag::create([
                'title' => 'Development'
            ]);
        }
    }
}
