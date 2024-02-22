<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            StatusSeeder::class
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => '123456',
            'role_id' => '1'
        ]);

        User::create([
            'name' => 'Helpdesk',
            'email' => 'helpdesk@example.com',
            'password' => '123456',
            'role_id' => '2'
        ]);

        User::create([
            'name' => 'Monteur',
            'email' => 'Monteur@example.com',
            'password' => '123456',
            'role_id' => '3'
        ]);
    }
}
