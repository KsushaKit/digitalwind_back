<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourJury extends Model
{
    protected $fillable = ['tour_id','jury_id'];

    public function tour()
    {
        return $this->belongsTo('App\Tour');
    }

    public function jury()
    {
        return $this->belongsTo('App\Jury');
    }
}
