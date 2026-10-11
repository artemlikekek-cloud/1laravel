<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'IT',
                'slug' => 'it',
                'description' => 'Новости информационных технологий',
            ],
            [
                'name' => 'Космос',
                'slug' => 'cosmos',
                'description' => 'Исследования космоса и астрономия',
            ],
            [
                'name' => 'Медицина',
                'slug' => 'medicine',
                'description' => 'Достижения в медицине и здравоохранении',
            ],
            [
                'name' => 'Робототехника',
                'slug' => 'robotics',
                'description' => 'Новости в области робототехники',
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
