<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(User::where('email', 'admin@argon.com')->get()->isEmpty()) {
            DB::table('users')->insert([
                // 'username' => 'admin',
                'name' => 'Admin',
                // 'lastname' => 'Admin',
                'email' => 'admin@argon.com',
                'password' => bcrypt('secret')
            ]);
        }
        
        $this->call([
            RoleSeeder::class, 
            ClientSeeder::class, 
            UserSeeder::class, 
            ProjectSeeder::class, 
            TagSeeder::class, 
            TaskSeeder::class
        ]);
    }
}
