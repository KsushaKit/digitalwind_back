<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NominationTour extends Model
{
    protected $fillable = ['nomination_id', 'tour_id'];

    public function nomination()
    {
        return $this->belongsTo('App\Nomination');
    }

    public function ageGroup()
    {
        return $this->belongsTo('App\Tour');
    }

}
