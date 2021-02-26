<?php

namespace App\Http\Controllers\Admin;

use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Location;
use App\Models\Driver;
use App\Models\Car;
use App\Http\Controllers\Controller;

class AdminDriverController extends Controller
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
        //
        $drivers = Driver::with('manager')->get();
        return view('admin.drivers.index', ['drivers' => $drivers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //´
        $managers = Manager::all();
        return view('admin.drivers.create', ['managers' => $managers]);
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
            'name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
            'manager' => 'required',
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
        $driver->manager_id = $request->manager;
        if ($request->password != '') {
            $driver->password = Hash::make($request->password);
        }

        $driver->save();
        Toastr::success('Driver Successfully Updated');
        return redirect()->route('admin.drivers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $projectExists = Driver::where('id', $id)->exists();
        if (!$projectExists) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $projectExists = Driver::where('id', $id)->exists();
        if (!$projectExists) {
            abort(404);
        }

        $driver = Driver::find($id);
        $managers = Manager::all();
        $cars = Car::where('driver_id', $id);
        return view('admin.drivers.edit', ['cars' => $cars, 'driver' => $driver, 'managers' => $managers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //
        $driver = Driver::findOrFail($id);
        $location = new Location();

        $request->validate([
            'name' => 'required|max:255',
            'latitude' => 'required',
            'longitude' => 'required',
            'manager' => 'required',
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
        $driver->manager_id = $request->manager;
        if ($request->password != '') {
            $driver->password = Hash::make($request->password);
        }

        $driver->save();
        Toastr::success('Driver Successfully Updated');
        return redirect()->route('admin.drivers.index');
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
        return redirect()->route('admin.drivers.index');
    }
}
