<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CreationJurySeeder extends Seeder
{
    public function run()
    {
        DB::table('creation_juries')->insert([
            [
                'score1' => '0',
                'score2' => '0',
                'creation_id' => '1',
                'jury_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'score1' => '0',
                'score2' => '0',
                'creation_id' => '2',
                'jury_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
