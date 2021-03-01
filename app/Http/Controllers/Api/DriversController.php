<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\DB;
use App\Models\Driver;
use App\Models\Car;
use App\Http\Controllers\Controller;

class DriversController extends Controller
{
  /**
     * Create a new controller instance.
     *
     * @return void
     */
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCars($id)
    {

   
        $cars  = DB::table('cars')->select('cars.brand', 'cars.model', 'locations.latitude', 'locations.longitude', 'cars.id as car_id')
        ->leftJoin('drivers as drivers', 'cars.driver_id', '=', 'drivers.id')
        ->leftJoin('locations as locations', 'cars.location_id', '=', 'locations.id')
        ->where('cars.driver_id','=',$id)
        ->get();
        return response()->json($cars, 200);
    }


}
