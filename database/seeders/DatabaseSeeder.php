<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
        ])->assignRole('admin');

        User::create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => bcrypt('password')
        ])->assignRole('user');

    }
}
