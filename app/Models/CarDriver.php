<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;
use App\Models\Car;

class CarDriver extends Model
{
    protected $table = 'car_drivers';

    public function car()
    {
        return $this->belongsToMany(Car::class);
    }

    public function driver()
    {
        return $this->belongsToMany(Driver::class);
    }
}
