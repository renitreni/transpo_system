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

        // Admins Account
        \App\Models\User::factory()->create([
            'name' => 'Ibraheem',
            'email' => 'ibraheem@alesnaad.online',
            'role' => 'Admin',
            'password' => Hash::make('Ibraheem2024'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Koshnor',
            'role' => 'Admin',
            'email' => 'koshnor@alesnaad.online',
            'password' => Hash::make('Koshnor2024'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Fouzan',
            'role' => 'Admin',
            'email' => 'fouzan@alesnaad.online',
            'password' => Hash::make('Fouzan2024'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'role' => 'Admin',
            'email' => 'Admin@alesnaad.online',
            'password' => Hash::make('Admin2024'),
        ]);

        // Employees Account
        \App\Models\User::factory()->create([
            'name' => 'Mechanic',
            'email' => 'mechanic@alesnaad.online',
            'role' => 'Mechanic',
            'password' => Hash::make('Mechanic2024'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Ensign',
            'email' => 'admin@ensign',
            'role' => 'Ensign',
            'password' => Hash::make('Ensign_123'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Camc',
            'email' => 'admin@camc',
            'role' => 'Camc',
            'password' => Hash::make('Camc_123'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Ibraheem',
            'email' => 'ibraheem@renting',
            'role' => 'Renting',
            'password' => Hash::make('Ibraheem_123'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Hasan',
            'email' => 'hasan@renting',
            'role' => 'Fleet',
            'password' => Hash::make('Hasan_123'),
        ]);
    }
}
