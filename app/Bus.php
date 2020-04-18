<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    //
    protected $table = 'buses';

    protected $fillable = ['bus_id', 'route_id','source','destination','depature_time','arivel_time','bus_type','is_Local'];
}
