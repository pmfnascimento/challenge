<?php

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;

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
            'longitude' => $faker->latitude($min = -8.7, $max = -8.5),
            'latitude' => $faker->longitude($min = 41, $max = 42),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('locations')->insert([
            'longitude' => $faker->latitude($min = -8.7, $max = -8.5),
            'latitude' => $faker->longitude($min = 41, $max = 42),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('locations')->insert([
            'longitude' => $faker->latitude($min = -8.7, $max = -8.5),
            'latitude' => $faker->longitude($min = 41, $max = 42),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('locations')->insert([
            'longitude' => $faker->latitude($min = -8.7, $max = -8.5),
            'latitude' => $faker->longitude($min = 41, $max = 42),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('locations')->insert([
            'longitude' => $faker->latitude($min = -8.7, $max = -8.5),
            'latitude' => $faker->longitude($min = 41, $max = 42),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('locations')->insert([
            'longitude' => $faker->latitude($min = -8.7, $max = -8.5),
            'latitude' => $faker->longitude($min = 41, $max = 42),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('locations')->insert([
            'longitude' => $faker->latitude($min = -8.7, $max = -8.5),
            'latitude' => $faker->longitude($min = 41, $max = 42),
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
