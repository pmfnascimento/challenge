<?php

namespace App\Http\Controllers\Admin;

use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Driver;
use App\Models\Car;
use App\Http\Controllers\Controller;

class AdminCarController extends Controller
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
        $cars = Car::all();

        return view('admin.cars.index', ['cars' => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $drivers = Driver::all();
        return view('admin.cars.create', ['drivers' => $drivers]);
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
            'brand' => 'required|max:255',
            'model' => 'required',
            'plate_number' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
            'driver' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $location = $car->locations()->create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);


        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->plate_number = $request->plate_number;
        $car->location_id = $location->id;
        $car->driver_id = $request->driver;

        $car->save();
        Toastr::success('Car Successfully Created');
        return redirect()->route('admin.cars.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectExists = Car::where('id', $id)->exists();
        if (!$projectExists) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Car::findOrFail($id);

        $drivers = Car::with('driver')->with('location')->where('id', $id)->get();

        $driversAll = Driver::all();

        return view('admin.cars.edit', [
            'car' => $car,
            'drivers' => $drivers,
            'driversAll' => $driversAll
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $car = new Car();
        $location = new Location();

        $request->validate([
            'brand' => 'required|max:255',
            'model' => 'required',
            'plate_number' => 'required|string',
            'latitude' => 'required',
            'longitude' => 'required',
            'driver' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        $location = $car->locations()->create([
            'latitude' => $request->latitude,
            'longitude' => $request->longitude
        ]);


        $car->brand = $request->brand;
        $car->model = $request->model;
        $car->plate_number = $request->plate_number;
        $car->location_id = $location->id;
        $car->driver_id = $request->driver;

        $car->save();
        Toastr::success('Car Successfully Created');
        return redirect()->route('admin.cars.index');
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
        return redirect()->route('admin.cars.index');
    }
}
