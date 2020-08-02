<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type_of_land extends Model
{
    public function files(){
        return $this->hasMany('App\Models\File', 'type_id');
    }
}
