<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

    public function exams()
    {
        return $this->belongsToMany('App\Exam')->withPivot('stage_number');;
    }

    public function answers()
    {
        return $this->belongsToMany('App\Answer');
    }

    public function menus()
    {
        return $this->hasMany('App\Menu', 'role', 'role');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
