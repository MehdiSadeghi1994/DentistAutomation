<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }

    public function group()
    {
        return $this->belongsTo('App\Group')->withDefault();
    }

    public function videos()
    {
        return $this->hasMany('App\Video');
    }

    public function urese()
    {
        return $this->belongsToMany('App\User');
    }
}
