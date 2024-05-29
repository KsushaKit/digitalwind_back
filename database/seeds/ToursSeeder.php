<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ToursSeeder extends Seeder
{
    public function run()
    {
        DB::table('tours')->insert([
            [
                'title' => 'Всероссийский',
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Региональный Саратов',
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Региональный Сочи',
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Региональный Анапа',
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
