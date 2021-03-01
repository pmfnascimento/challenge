<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Location;
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

    public function getCar($id)
    {
        $car = Car::find($id)->with('location')->get();
        return response()->json($car, 200);
    }

    public function setCar(Request $request,$id)
    {
        $car = Car::find($id);
 
        $car->location()->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);

        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->plate_number = $request->plate_number;
        $car->save();
        return redirect()->route('drivers.home');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $car = Car::findOrFail($id);
        $car->delete();
        return redirect()->route('drivers.home');
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $car = new Car();
        $location = new Location();

        $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'plate_number' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $location = $car->location()->create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);


        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->plate_number = $request->plate_number;
        $car->location_id = $location->id;
        $car->driver_id = $request->driver_id;

        $car->save();
        return redirect()->route('drivers.home');
    }
}
