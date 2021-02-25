<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'John Doe',
            'email' => 'admin@challenge.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
