<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stops extends Model
{
    //
    protected $table = 'stops';
    protected $casts = ['bus_stopes' => 'array'];
    protected $fillable = ['route_id', 'bus_stopes'];
}
