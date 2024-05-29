<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = ['title'];
    
    public function nomination_tour()
    {
        return $this->hasMany('App\NominationTour');
    }

    public function creation()
    {
        return $this->hasMany('App\Creation');
    }

    public function tour_juries()
    {
        return $this->hasMany('App\TourJury');
    }
}
