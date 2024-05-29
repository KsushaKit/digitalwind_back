<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NominationsSeeder extends Seeder
{
    public function run()
    {
        DB::table('nominations')->insert([
            [
                'title' => 'Лучший фотограф',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Лучший рисунок',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
