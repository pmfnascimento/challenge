<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drivers')->insert([
            'name' => 'Leson Mark',
            'email' => 'driver@challenge.com',
            'password' => Hash::make('password'),
            'location_id' => 1,
            'manager_id' => 1,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
