<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        
        $this->call([
            StructureSeeder::class,
        ]);

        $this->call([
            DaySeeder::class,
        ]);

        \App\Models\User::factory()->create([
            'structure_id' => 1,
            'name' => 'Test',
            'firstname' => 'User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]);
    }
}
