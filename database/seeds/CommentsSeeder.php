<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    public function run()
    {
        DB::table('comments')->insert([
            [
                'name_sender' => 'Alice',
                'surname_sender' => 'Smith',
                'text' => 'Another comment here.',
                'date' => '2023-02-21',
                'creation_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_sender' => 'Bob',
                'surname_sender' => 'Johnson',
                'text' => 'Yet another comment.',
                'date' => '2023-02-22',
                'creation_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_sender' => 'Elena',
                'surname_sender' => 'Kovalenko',
                'text' => 'One more comment for testing.',
                'date' => '2023-02-23',
                'creation_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name_sender' => 'Maxim',
                'surname_sender' => 'Ivanov',
                'text' => 'Testing comment number five.',
                'date' => '2023-02-24',
                'creation_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
