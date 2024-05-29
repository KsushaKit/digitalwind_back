<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendeesSeeder extends Seeder
{
    public function run()
    {
        DB::table('attendees')->insert([
            [
                'surname' => 'Петрова',
                'name' => 'Мария',
                'patronymic' => 'Александровна',
                'birth_date' => '1998-12-28',
                'email' => 'petrova@example.com',
                'phone_number' => '+1987654321',
                'country' => 'Россия',
                'region' => 'Саратовская область',
                'city' => 'Саратов',
                'educational_institution' => 'СГТУ',
                'educational_institution_type' => 'Вуз',
                'institute' => 'ИнПИТ',
                'specialization' => 'ИФСТ',
                'course' => '3 курс',
                'class' => null,
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
