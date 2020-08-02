<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuildingDirection extends Model
{
    public function files(){
        return $this->hasMany('App\Models\File', 'direction_id');
    }
}
