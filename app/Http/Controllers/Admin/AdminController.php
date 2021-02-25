<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use App\Models\Manager;
use App\Models\Driver;
use App\Models\Admin;
use App\Http\Controllers\Controller;

class AdminController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Admin::all()->count();
        $managers = Manager::all()->count();
        $drivers = Driver::all()->count();

        $lastManagers = Manager::orderBy('name', 'ASC')->withCount('driver')->take(5)->get();
        $lastDrivers = Driver::orderBy('name', 'ASC')->take(5)->get();
        return view('admin.home', [
            'users' => $users,
            'managers' => $managers,
            'drivers' => $drivers,
            'lastManagers' => $lastManagers,
            'lastDrivers' => $lastDrivers
        ]);
    }

    /**
     * Logout from admin area 
     *
     * @return  void 
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
