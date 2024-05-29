<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $fillable = ['id', 'surname', 'name', 'patronymic', 'birth_date', 'email', 'phone_number', 'country', 'region', 'city', 'add_educational', 'educational_institution_type', 'educational_institution', 'institute', 'specialization', 'course', 'class','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function creations()
    {
        return $this->hasMany('App\Creation');
    }
}
