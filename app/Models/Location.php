<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;

class Location extends Model
{
    public function driver()
    {
        return $this->HasMany(Driver::class);
    }
}
