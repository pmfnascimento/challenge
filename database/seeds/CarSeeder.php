<?php
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Carbon\Carbon;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
  
        DB::table('cars')->insert([
            'brand' => $faker->name,
            'model' => $faker->userName,
            'plate_number' => $faker->postcode,
            'location_id' => 1,
            'driver_id' => 1,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);

        DB::table('cars')->insert([
            'brand' => $faker->name,
            'model' => $faker->userName,
            'plate_number' => $faker->postcode,
            'location_id' => 2,
            'driver_id' => 2,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);


        DB::table('cars')->insert([
            'brand' => $faker->name,
            'model' => $faker->userName,
            'plate_number' => $faker->postcode,
            'location_id' => 3,
            'driver_id' => 3,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);


        DB::table('cars')->insert([
            'brand' => $faker->name,
            'model' => $faker->userName,
            'plate_number' => $faker->postcode,
            'location_id' => 4,
            'driver_id' => 4,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);


        DB::table('cars')->insert([
            'brand' => $faker->name,
            'model' => $faker->userName,
            'plate_number' => $faker->postcode,
            'location_id' => 5,
            'driver_id' => 5,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);


        DB::table('cars')->insert([
            'brand' => $faker->name,
            'model' => $faker->userName,
            'plate_number' => $faker->postcode,
            'location_id' => 6,
            'driver_id' => 6,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);


        DB::table('cars')->insert([
            'brand' => $faker->name,
            'model' => $faker->userName,
            'plate_number' => $faker->postcode,
            'location_id' => 7,
            'driver_id' => 7,
            'created_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
