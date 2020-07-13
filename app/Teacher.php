<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
	public function degree()
	{
		return $this->belongsTo('App\Degree')->withDefault();
	}

    public function i3classes()
    {
        return $this->hasMany('App\I3class');
    }
}
