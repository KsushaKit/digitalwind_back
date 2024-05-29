<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JuriesSeeder extends Seeder
{
    public function run()
    {
        DB::table('juries')->insert([
            [
                'surname' => 'Иванов',
                'name' => 'Иван',
                'patronymic' => 'Иванович',
                'email' => 'ivanov@example.com',
                'nominations' => '[1,2]',
                'age_categories' => '[1,2,3]',
                'tours' => '[1,2,3,4]',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
