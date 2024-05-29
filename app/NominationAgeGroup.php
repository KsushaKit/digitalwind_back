<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NominationAgeGroup extends Model
{
    protected $fillable = ['noination_id','age_group_id'];

    public function nomination()
    {
        return $this->belongsTo('App\Nomination');
    }

    public function age_group()
    {
        return $this->belongsTo('App\AgeGroup');
    }
}
