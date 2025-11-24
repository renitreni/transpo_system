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
            'email' => 'admin1@alesnaad.online',
            'role' => 'Admin',
            'password' => Hash::make('password'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Koshnor',
            'role' => 'Admin',
            'email' => 'admin2@alesnaad.online',
            'password' => Hash::make('password'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Fouzan',
            'role' => 'Admin',
            'email' => 'admin3@alesnaad.online',
            'password' => Hash::make('password'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'role' => 'Admin',
            'email' => 'admin4@alesnaad.online',
            'password' => Hash::make('password'),
        ]);

        // Employees Account
        \App\Models\User::factory()->create([
            'name' => 'Mechanic',
            'email' => 'mechanic1@alesnaad.online',
            'role' => 'Mechanic',
            'password' => Hash::make('password'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'FAW',
            'email' => 'FAW1@alesnaad.online',
            'role' => 'FAW',
            'password' => Hash::make('password'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'OTHER',
            'email' => 'OTHER1@alesnaad.online',
            'role' => 'OTHER',
            'password' => Hash::make('password'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Ibraheem',
            'email' => 'renting1@alesnaad.online',
            'role' => 'Renting',
            'password' => Hash::make('password'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Hasan',
            'email' => 'fleet1@alesnaad.online',
            'role' => 'Fleet',
            'password' => Hash::make('password'),
        ]);
    }
}
