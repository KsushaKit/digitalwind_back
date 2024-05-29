<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NominationTourSeeder extends Seeder
{
    public function run()
    {
        DB::table('nomination_tours')->insert([
            'nomination_id' => 1,
            'tour_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('nomination_tours')->insert([
            'nomination_id' => 2,
            'tour_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('nomination_tours')->insert([
            'nomination_id' => 1,
            'tour_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('nomination_tours')->insert([
            'nomination_id' => 2,
            'tour_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
