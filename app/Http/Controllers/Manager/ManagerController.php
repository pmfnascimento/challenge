<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Support\Facades\Auth;
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
        $this->middleware(['auth:manager', 'preventBackHistory']);
    }
    
    /**
     * Show the Manager dashboard.
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
     * Show the create Driver Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::guard('manager')->user()->id;
        return view('managers.create', ['id' => $id]);
    }
}
