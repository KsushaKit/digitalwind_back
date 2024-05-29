<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'login' => 'admin123',
                'password' => bcrypt('adminpassword'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'login' => 'jury456',
                'password' => bcrypt('jurypassword'),
                'role' => 'jury',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'login' => 'attendee789',
                'password' => bcrypt('attendeepassword'),
                'role' => 'attendee',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
