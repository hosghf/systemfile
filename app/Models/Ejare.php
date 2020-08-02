<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ejare extends Model
{
    protected $table = 'ejare';


    public function file(){
        return $this->belongsTo('App\Models\File');
    }
}
