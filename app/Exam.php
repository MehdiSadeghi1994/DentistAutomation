<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public function course()
    {
        return $this->belongsTo('App\Course')->withDefault();
    }

    public function stages()
    {
        return $this->hasMany('App\Stage');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
