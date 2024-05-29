<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AgeGroupJurySeeder extends Seeder
{
    public function run()
    {
        DB::table('age_group_juries')->insert([
            [
                'age_group_id' => '1',
                'jury_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'age_group_id' => '2',
                'jury_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'age_group_id' => '3',
                'jury_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
