<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    public function files(){
        return $this->hasMany('App\Models\File');
    }

    public function customers(){
        return $this->belongsToMany('App\Models\Customer');
    }
}
