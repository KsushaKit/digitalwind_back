<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgeGroupsSeeder extends Seeder
{
    public function run()
    {
        DB::table('age_groups')->insert([
            [
                'title' => 'До 12 лет',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '13-17 лет',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '18-25 лет',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
