<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            [
                'surname' => 'Петров',
                'name' => 'Петр',
                'patronymic' => 'Петрович',
                'email' => 'petrov@example.com',
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
