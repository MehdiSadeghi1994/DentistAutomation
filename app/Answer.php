<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function question()
    {
        return $this->belongsTo('App\Question')->withDefault();
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
