<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    public function Exam()
    {
        return $this->belongsTo('App\Exam')->withDefault();
    }

    public function lesson()
    {
        return $this->hasOne('App\Lesson');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
