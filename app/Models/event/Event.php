<?php

namespace App\Models\event;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'target_audience',
        'max_members',
        'current_members'
    ];

    protected $casts = [
        'max_members' => 'integer',
        'current_members' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'event_speaker');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
