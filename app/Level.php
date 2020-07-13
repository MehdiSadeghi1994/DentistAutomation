<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public function courses()
    {
        return $this->hasMany('App\Course');
    }
}
