<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgeGroupJury extends Model
{
    protected $fillable = ['age_group_id','jury_id'];

    public function age_group()
    {
        return $this->belongsTo('App\AgeGroup');
    }

    public function jury()
    {
        return $this->belongsTo('App\Jury');
    }
}
