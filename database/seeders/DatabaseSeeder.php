<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // php artisan orchid:admin admin admin@admin.com password
        
        // User::factory()->create([
        //     'name' => 'superadmin',
        //     'email' => 'superadmin@admin.com',
        //     'password' => bcrypt('superadmin'),
            

        // ]);
    }
}
