<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function stage()
    {
        return $this->belongsTo('App\Stage')->withDefault();
    }
}
