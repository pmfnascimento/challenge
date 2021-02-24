<?php

namespace App\Http\Controllers\Driver;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('driver.home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('status', 'User has been logged out!');
    }
}
