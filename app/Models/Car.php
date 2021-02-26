<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\Driver;

class Car extends Model
{
    protected $table = 'cars';

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
