<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creation extends Model
{
    protected $fillable = ['id', 'attendee_name', 'attendee_surname', 'attendee_pathronymic', 'age', 'title', 'img', 'rating', 'description', 'file', 'link', 'status', 'round', 'other_attendee', 'project_manager', 'tour_id', 'nomination_id', 'age_group_id', 'attendee_id'];
    protected $casts = [
        'attendee_id' => 'integer'
    ];

    public function nomination()
    {
        return $this->belongsTo('App\Nomination');
    }

    public function ageGroup()
    {
        return $this->belongsTo('App\AgeGroup');
    }

    public function attendee()
    {
        return $this->belongsTo('App\Attendee');
    }

    public function tour()
    {
        return $this->belongsTo('App\Tour');
    }

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }
    
    public function creation_juries()
    {
        return $this->hasMany('App\CreationJury');
    }
}
