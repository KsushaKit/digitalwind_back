<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'text', 'img', 'date', 'max_members', 'current_members'];
    protected $casts = [
        'max_members' => 'integer',
        'current_members' => 'integer',
    ];


}
