<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function file(){
        return $this->belongsTo('App\Models\File');
    }
}
