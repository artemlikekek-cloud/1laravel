<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'user',
                'description' => 'Обычный пользователь',
            ],
            [
                'name' => 'journalist',
                'description' => 'Журналист - может создавать статьи',
            ],
            [
                'name' => 'admin',
                'description' => 'Администратор - полный доступ',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
