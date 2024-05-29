<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TourJury extends Seeder
{
    public function run()
    {
        DB::table('tour_juries')->insert([
            [
                'jury_id' => '1',
                'tour_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jury_id' => '1',
                'tour_id' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'jury_id' => '1',
                'tour_id' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
