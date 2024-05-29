<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoundsSeeder extends Seeder
{
    public function run()
    {
        DB::table('rounds')->insert([
            [
                'name' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
