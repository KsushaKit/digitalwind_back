<?php

namespace App\Models\event;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['url', 'event_id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
