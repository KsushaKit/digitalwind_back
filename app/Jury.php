<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jury extends Model
{
    protected $fillable = ['id', 'surname', 'name', 'patronymic', 'email', 'user_id', 'nominations', 'tours', 'age_categories'];

     // Указываем, что эти поля должны быть автоматически сериализованы в array
     protected $casts = [
        'nominations' => 'array',
        'tours' => 'array',
        'age_categories' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function nomination_juries()
    {
        return $this->hasMany('App\NominationJury');
    }

    public function age_group_juries()
    {
        return $this->hasMany('App\AgeGroupJury');
    }

    public function tour_juries()
    {
        return $this->hasMany('App\TourJury');
    }
    
    public function creation_juries()
    {
        return $this->hasMany('App\CreationJury');
    }
}
