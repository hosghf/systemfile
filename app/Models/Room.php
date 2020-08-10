<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function files(){
        return $this->hasMany('App\Models\File');
    }
}
