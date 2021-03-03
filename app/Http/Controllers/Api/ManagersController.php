<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Driver;
use App\Http\Controllers\Controller;

class ManagersController extends Controller
{
    /**
     * Get Drivers By Manager Id
     * 
     * @param int $id Id From Manager
     *
     * @return \Illuminate\Http\Response
     */
    public function getDrivers($id)
    {
        $id = Auth::guard('manager')->user()->id;
        $managers = Driver::select('drivers.name', 'drivers.email', 'drivers.created_at','drivers.id as driver_id')
        ->where('manager_id','=',$id)->withCount('car')->get();
        return response()->json($managers, 200);
    }

    /**
     * Get Information from Driver associated by Location
     *
     * @param int $id Id from Driver
     *
     * @return \Illuminate\Http\Response
     */
    public function getDriver($id){
        $driver = Driver::where('id',$id)->with('location')->get();
        return response()->json($driver, 200);
    }

    /**
     * Get Cars By Driver Id
     * 
     * @param int $id Id from Driver
     *
     * @return \Illuminate\Http\Response
     */
    public function getCars($id)
    {
        $cars  = DB::table('cars')->select('cars.brand', 'cars.model', 'cars.plate_number','locations.latitude', 'locations.longitude', 'cars.id as car_id')
        ->leftJoin('drivers as drivers', 'cars.driver_id', '=', 'drivers.id')
        ->leftJoin('locations as locations', 'cars.location_id', '=', 'locations.id')
        ->where('cars.driver_id','=',$id)
        ->get();
        return response()->json($cars, 200);
    }

    /**
     * Update Information from Driver in Database
     *
     * @param Request $request
     * @param int $id From Driver
     *
     * @return \Illuminate\Http\Response
     */
    public function setDriver(Request $request, $id)
    {

        $driver = Driver::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $driver->location()->update([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        $driver->name = $request->name;
        $driver->email = $request->email;
        if ($request->password != '') {
            $driver->password = Hash::make($request->password);
        }

        $driver->save();
        return redirect()->route('managers.home');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $driver = new Driver();
        $location = new Location();

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $location = $driver->location()->create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        $driver->name = $request->name;
        $driver->email = $request->email;
        $driver->location_id = $location->id;
        $driver->manager_id = $request->manager_id;
        $driver->password = Hash::make($request->password);
        
        $driver->save();
        return redirect()->route('managers.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $driver = Driver::findOrFail($id);
        $driver->delete();
        return redirect()->route('managers.home');
    }
}
