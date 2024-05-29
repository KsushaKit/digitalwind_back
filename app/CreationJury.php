<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreationJury extends Model
{
    protected $fillable = ['creation_id','score1','score2','jury_id'];

    public function creation()
    {
        return $this->belongsTo('App\Creation');
    }

    public function jury()
    {
        return $this->belongsTo('App\Jury');
    }
}
