<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['name_sender', 'surname_sender', 'text', 'date', 'creation_id'];

    public function creation()
    {
        return $this->belongsTo('App\Creation');
    }
}
