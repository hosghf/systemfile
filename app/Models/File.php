<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function street(){
        return $this->belongsTo('App\Models\Street');
    }

    public function cabinet(){
        return $this->belongsTo('App\Models\Cabinet');
    }

    public function BuildingDirection(){
        return $this->belongsTo('App\Models\BuildingDirection', 'direction_id');
    }

    public function cooling(){
        return $this->belongsTo('App\Models\Cooling', 'cooling_id');
    }
    public function floor(){
        return $this->belongsTo('App\Models\Floor');
    }

    public function heating(){
        return $this->belongsTo('App\Models\Heating');
    }

    public function sanad(){
        return $this->belongsTo('App\Models\Sanad');
    }

    public function tabaghe(){
        return $this->belongsTo('App\Models\Tabaghe');
    }

    public function room(){
        return $this->belongsTo('App\Models\Room');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category', 'cat_id');
    }

    public function facilities(){
        return $this->hasMany('App\Models\Facility');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function images(){
        return $this->hasMany('App\Models\Image');
    }
}
