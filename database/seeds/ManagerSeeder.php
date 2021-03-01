<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ManagerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('managers')->insert([
            'name' => 'Alison Sell',
            'email' => 'manager@challenge.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('managers')->insert([
            'name' => 'Steven Smith',
            'email' => 'steven@challenge.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('managers')->insert([
            'name' => 'Dasy Also',
            'email' => 'dasy@challenge.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('managers')->insert([
            'name' => 'Robison Sell',
            'email' => 'robison@challenge.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
