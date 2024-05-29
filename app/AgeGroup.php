<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgeGroup extends Model
{
    protected $fillable = ['title'];

    public function age_group_juries()
    {
        return $this->hasMany('App\AgeGroupJury');
    }

    public function nomination_ageGroups()
    {
        return $this->hasMany('App\NominationAgeGroup');
    }

    public function creations()
    {
        return $this->hasMany('App\Creation');
    }
}
