<?php

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('locations')->insert([
            'longitude' => $faker->latitude($min = -90, $max = 90),
            'latitude' => $faker->longitude($min = -180, $max = 180),
        ]);
    }
}
