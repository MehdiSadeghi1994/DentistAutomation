<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function stage()
    {
        return $this->belongsTo('App\Stage')->withDefault();
    }

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
