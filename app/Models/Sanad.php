<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sanad extends Model
{
    protected $table = 'sanad';

    public function files(){
        return $this->hasMany('App\Models\File');
    }

}
