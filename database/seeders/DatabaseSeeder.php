<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(CategorySeeder::class);

        // Get roles
        $adminRole = Role::where('name', 'admin')->first();
        $userRole = Role::where('name', 'user')->first();

        // Create admin user
        User::create([
            'username' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('admin'),
            'role_id' => $adminRole->id,
        ]);

        // Create a test user
        User::create([
            'username' => 'testuser',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role_id' => $userRole->id,
        ]);
    }
}
