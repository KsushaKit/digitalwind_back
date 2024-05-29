<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nomination extends Model
{
    protected $fillable = ['title', 'tour_id', 'age_group_id'];

    public function nomination_tour()
    {
        return $this->hasMany('App\NominationTour');
    }

    public function nomination_juries()
    {
        return $this->hasMany('App\NominationJury');
    }

    public function creations()
    {
        return $this->hasMany('App\Creation');
    }

    public function nomination_ageGroups()
    {
        return $this->hasMany('App\NominationAgeGroup');
    }
}
