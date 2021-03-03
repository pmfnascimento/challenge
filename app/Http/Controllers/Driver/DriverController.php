<?php

namespace App\Http\Controllers\Driver;

use Illuminate\Support\Facades\Auth;
use App\Models\Driver;
use App\Models\Car;
use App\Http\Controllers\Controller;

class DriverController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:driver', 'preventBackHistory']);
    }

    /**
     * Get Driver By Id
     *
     * @return Object
     */
    public function getManagers()
    {
        $id = Auth::guard('driver')->user()->id;
        $managers = Driver::where('id', $id)->with('manager:id,name')->get();
        return $managers;
    }

    /**
     * Show the application Driver dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = $this->getManagers();
        return view('drivers.home', ['managers' => $managers]);
    }

    /**
     * Get information of Manager By id Driver
     *
     * @param int $id Id from Driver
     *
     * @return \Illuminate\Http\Response
     */
    public function editCar($id)
    {
        $managers = $this->getManagers();
        return view('drivers.edit', ['id' => $id, 'managers' => $managers]);
    }

    /**
     * Show the create Car page Driver.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::guard('driver')->user()->id;
        $managers = $this->getManagers();
        return view('drivers.create', ['id' => $id, 'managers' => $managers]);
    }
}
