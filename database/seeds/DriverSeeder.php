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

        DB::table('drivers')->insert([
            'name' => 'Fisher Step',
            'email' => 'fisher@challenge.com',
            'password' => Hash::make('password'),
            'location_id' => 2,
            'manager_id' => 1,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);


        DB::table('drivers')->insert([
            'name' => 'Dino Real',
            'email' => 'dino@challenge.com',
            'password' => Hash::make('password'),
            'location_id' => 3,
            'manager_id' => 3,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);


        DB::table('drivers')->insert([
            'name' => 'Maria Ribeiro',
            'email' => 'maria@challenge.com',
            'password' => Hash::make('password'),
            'location_id' => 4,
            'manager_id' => 4,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);


        DB::table('drivers')->insert([
            'name' => 'Guilherm Cassa',
            'email' => 'guilherm@challenge.com',
            'password' => Hash::make('password'),
            'location_id' => 5,
            'manager_id' => 4,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);


        DB::table('drivers')->insert([
            'name' => 'Carl Muy',
            'email' => 'carl@challenge.com',
            'password' => Hash::make('password'),
            'location_id' => 6,
            'manager_id' => 3,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);


        DB::table('drivers')->insert([
            'name' => 'John Steve',
            'email' => 'john@challenge.com',
            'password' => Hash::make('password'),
            'location_id' => 7,
            'manager_id' => 2,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
