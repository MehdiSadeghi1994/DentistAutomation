<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class I3class extends Model
{
    public function course()
    {
        return $this->belongsTo('App\Course')->withDefault();
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher')->withDefault();
    }

    public function teacher_assistant()
    {
        return $this->belongsTo('App\Teacher')->withDefault();
    }

    public function classroom()
    {
        return $this->belongsTo('App\Classroom')->withDefault();
    }

    public function class_type()
    {
        return $this->belongsTo('App\ClassType')->withDefault();
    }
}
