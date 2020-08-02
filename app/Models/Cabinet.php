<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
    public function files(){
        return $this->hasMany('App\Models\File');
    }
}
