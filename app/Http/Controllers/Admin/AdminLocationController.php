<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Models\Location;
use App\Http\Controllers\Controller;

class AdminLocationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:admin', 'preventBackHistory']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $locations = DB::table('locations')->select('*', 'locations.id as id', 'drivers.location_id as driver_location', 'cars.location_id as car_location', 'locations.created_at as location_created_at')
            ->leftJoin('drivers', 'locations.id', '=', 'drivers.location_id')
            ->leftJoin('cars', 'locations.id', '=', 'cars.location_id')
            ->get();

        return view('admin.locations.index', ['locations' => $locations]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Exists = Location::where('id', $id)->exists();
        if (!$Exists) {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();
        return redirect()->route('admin.locations.index');
    }
}
