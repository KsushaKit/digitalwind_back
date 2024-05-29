<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NominationJury extends Model
{
    protected $fillable = ['nomination_id', 'jury_id'];

    public function nomination()
    {
        return $this->belongsTo('App\Nomination');
    }

    public function jury()
    {
        return $this->belongsTo('App\Jury');
    }
}
