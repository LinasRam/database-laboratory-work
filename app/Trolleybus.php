<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trolleybus extends Model
{
    public $timestamps = false;

    public function drivers()
    {
        return $this->belongsToMany('App\Driver');
    }
}
