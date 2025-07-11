<?php

namespace Database\Seeders;

use App\Models\level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            ['level_name' => 'Admin'],
            ['level_name' => 'User']
        ];

        foreach ($levels as $value) {
            level::create([
                'level_name' => $value['level_name']
            ]);
        }
    }
}
