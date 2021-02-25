<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CarDriver;

class Car extends Model
{
    protected $table = 'car';

    public function carsDriver()
    {
        return $this->belongsToMany(CarDriver::class);
    }
}
