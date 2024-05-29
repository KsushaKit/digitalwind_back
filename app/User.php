<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class User extends Model
{
    protected $fillable = ['login', 'password', 'role'];

    public function juries()
    {
        return $this->hasOne('App\Jury');
    }

    public function admins()
    {
        return $this->hasOne('App\Admin');
    }

    public function attendees()
    {
        return $this->hasOne('App\Attendee');
    }

    public function createToken()
    {
        return Crypt::encryptString(Str::random(40));
    }
}
