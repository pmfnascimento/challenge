<?php

namespace App\Models;

use Malhal\Geographical\Geographical;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;
use App\Models\Car;

class Location extends Model
{
    use Geographical;
    
    protected static $kilometers = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['latitude', 'longitude'];

    /**
     * Relationship between Location and Drivers
     *
     */
    public function driver()
    {
        return $this->hasMany(Driver::class);
    }

    /**
     * Relationship between Location and Cars
     *
     */
    public function car()
    {
        return $this->hasMany(Car::class);
    }
}
