<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('status', 'User has been logged out!');
    }
}
