<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Location;
use App\Models\Driver;
use App\Http\Controllers\Controller;

class ManagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:manager','preventBackHistory']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('managers.home');
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function editDriver($id)
    {
        return view('managers.edit', ['id' => $id]);
    }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::guard('manager')->user()->id;
        return view('managers.create', ['id' => $id]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('status', 'User has been logged out!');
    }

   
}
