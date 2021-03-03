<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\Driver;

class Car extends Model
{
    
    protected $table = 'cars';
    
    /**
     * Relationship between Car and Driver
     *
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    /**
     * Relationship between Car and Location
     *
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
