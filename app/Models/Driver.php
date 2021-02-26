<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Manager;
use App\Models\Location;
use App\Models\CarDriver;

class Driver extends Authenticatable
{
    use Notifiable;

    protected $table = 'drivers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'manager_id', 'location_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function car()
    {
        return $this->hasMany(Car::class);
    }
}
