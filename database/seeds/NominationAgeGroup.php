<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NominationAgeGroup extends Seeder
{
    public function run()
    {
        DB::table('nomination_ageGroups')->insert([
            [
                'nomination_id' => '2',
                'age_group_id' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nomination_id' => '2',
                'age_group_id' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nomination_id' => '2',
                'age_group_id' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nomination_id' => '1',
                'age_group_id' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nomination_id' => '1',
                'age_group_id' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
