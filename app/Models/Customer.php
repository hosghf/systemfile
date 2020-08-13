<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function streets(){
        return $this->belongsToMany('App\Models\Street');
    }
}
