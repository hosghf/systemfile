<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabaghe extends Model
{
    protected $table = 'tabaghe';

    public function files(){
        return $this->hasMany('App\Models\File');
    }
}
