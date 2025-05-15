<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'super_admin']);
        User::create([
            'name' => 'Super Admin',
            'email' => 'super_admin@example.com',
            'password' => bcrypt('password')
        ])->assignRole('super_admin');
    }
}
