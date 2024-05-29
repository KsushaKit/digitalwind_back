<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NominationJuriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('nomination_juries')->insert([
            [
                'nomination_id' => 1,
                'jury_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nomination_id' => 2,
                'jury_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
