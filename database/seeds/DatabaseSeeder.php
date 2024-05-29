<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(NewsSeeder::class); //1
        $this->call(AgeGroupsSeeder::class); //2
        $this->call(ToursSeeder::class); //3
        $this->call(UsersSeeder::class); //4
        $this->call(JuriesSeeder::class);//5
        $this->call(TourJury::class); //6
        $this->call(AgeGroupJurySeeder::class); //7
        $this->call(AdminsSeeder::class); //8
        $this->call(AttendeesSeeder::class); //9
        $this->call(NominationsSeeder::class); //10
        $this->call(NominationAgeGroup::class); //11
        $this->call(NominationTourSeeder::class); //12
        $this->call(NominationJuriesSeeder::class); //13
        $this->call(CreationsSeeder::class); //14
        $this->call(CreationJurySeeder::class); //15
        $this->call(RoundsSeeder::class); //16
    }
}
