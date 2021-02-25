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
    }
}
