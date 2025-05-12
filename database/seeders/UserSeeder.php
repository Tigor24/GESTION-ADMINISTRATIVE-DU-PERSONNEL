<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Agent',
            'email' => 'agent@example.com',
            'password' => bcrypt('secret'),
            'role' => 'agent'
        ]);

        User::create([
            'name' => 'Directeur',
            'email' => 'directeur@example.com',
            'password' => bcrypt('secret'),
            'role' => 'directeur'
        ]);

        User::create([
            'name' => 'RH',
            'email' => 'rh@example.com',
            'password' => bcrypt('secret'),
            'role' => 'rh'
        ]);

        User::create([
            'name' => 'DPAF',
            'email' => 'dpaf@example.com',
            'password' => bcrypt('secret'),
            'role' => 'dpaf'
        ]);
    }
}
