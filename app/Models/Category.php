<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function files(){
        return $this->hasMany('App\Models\File', 'cat_id');
    }
}
