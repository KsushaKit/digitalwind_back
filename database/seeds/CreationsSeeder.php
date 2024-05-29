<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreationsSeeder extends Seeder
{
    public function run()
    {
        DB::table('creations')->insert([
            [
                'attendee_name' => 'Мария',
                'attendee_surname' => 'Петрова',
                'attendee_pathronymic' => 'Александровна',
                'age' => 15,
                'title' => 'Моя картина',
                'img' => '1.jpg',
                'rating' => 5,
                'description' => 'Цветы на поле',
                'file' => '1.zip', 
                'link' => null,
                'status' => 'На рассмотрении',
                'round' => null,
                'other_attendee' => 'Наташа Иванова 15 лет',
                'project_manager' => 'Ирина Иванова',
                'tour_id' => 1,
                'nomination_id' => 1,
                'age_group_id' => 2,
                'attendee_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'attendee_name' => 'Мария',
                'attendee_surname' => 'Сидорова',
                'attendee_pathronymic' => 'Петровна',
                'age' => 30,
                'title' => 'Сакура',
                'img' => '2.jpg',
                'rating' => 4,
                'description' => 'Цветущая сакура',
                'file' => null, 
                'link' => 'https://docs.yandex.ru/docs/view?url=ya-disk-public%3A%2F%2FELL0Fdmn1A7nwnO9PwYTT4d668nzlVyg17THEw1m8EAwyW5JN9HXbzlLsRnFP4J8q%2FJ6bpmRyOJonT3VoXnDag%3D%3D%3A%2F%D0%9F%D1%80%D0%B0%D0%BA%D1%82%D0%B8%D0%BA%D0%B0%2Fmathlab_%D0%BF%D0%BE%D1%81%D0%BE%D0%B1%D0%B8%D0%B5.pdf&name=mathlab_%D0%BF%D0%BE%D1%81%D0%BE%D0%B1%D0%B8%D0%B5.pdf&nosw=1', 
                'status' => 'На рассмотрении',
                'round' => 1,
                'other_attendee' => null,
                'project_manager' => null,
                'tour_id' => 2,
                'nomination_id' => 2,
                'age_group_id' => 3,
                'attendee_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        
    }
}
