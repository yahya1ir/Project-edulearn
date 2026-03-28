<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Admins
        User::create([
            'name' => 'Admin One',
            'email' => 'admin1@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Admin Two',
            'email' => 'admin2@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Formateurs
        User::create([
            'name' => 'Formateur One',
            'email' => 'formateur1@example.com',
            'password' => Hash::make('password123'),
            'role' => 'formateur',
        ]);

        User::create([
            'name' => 'Formateur Two',
            'email' => 'formateur2@example.com',
            'password' => Hash::make('password123'),
            'role' => 'formateur',
        ]);

        User::create([
            'name' => 'Formateur Three',
            'email' => 'formateur3@example.com',
            'password' => Hash::make('password123'),
            'role' => 'formateur',
        ]);

        User::create([
            'name' => 'Formateur Four',
            'email' => 'formateur4@example.com',
            'password' => Hash::make('password123'),
            'role' => 'formateur',
        ]);
    }
}