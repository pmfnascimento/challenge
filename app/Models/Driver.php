<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Manager;
use App\Models\Location;
use App\Helpers\CreateAtCast;



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
        'created_at'        => CreateAtCast::class,
    ];

    protected $dates = ['created_at', 'updated_at'];
    
    /**
     * Relationship between Driver and Managers
     *
     */
    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }

    /**
     * Relationship between Driver and Locations
     *
     */
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * Relationship between Driver and Cars
     *
     */
    public function car()
    {
        return $this->hasMany(Car::class);
    }

}
