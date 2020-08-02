<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cooling extends Model
{
    public function files(){
        return $this->hasMany('App\Models\File', 'cooling_id');
    }
}
