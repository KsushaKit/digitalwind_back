<?php

namespace App\Models\event;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    protected $fillable = ['name', 'position'];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_speaker');
    }
}
