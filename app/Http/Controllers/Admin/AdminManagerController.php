<?php

namespace App\Http\Controllers\Admin;

use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Manager;
use App\Models\Driver;
use App\Http\Controllers\Controller;

class AdminManagerController extends Controller
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
        $managers = Manager::orderBy('name', 'DESC')->withCount('driver')->get();
        return view('admin.managers.index', ['managers' => $managers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.managers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', 'max:255',
            'email' => 'required|email',
            'password' => 'min:6'

        ]);

        $manager = new Manager();
        $manager->name = $request->name;
        $manager->email = $request->email;
        $manager->password = Hash::make($request->password);
        $manager->save();
        Toastr::success('Manager Successfully Created');
        return redirect()->route('admin.managers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectExists = Manager::where('id', $id)->exists();
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
        $manager = Manager::findOrFail($id);

        $drivers = Driver::orderBy('name', 'DESC')->with('manager')->with('location')->where('manager_id', $id)->get();

        $driversAll = Driver::all()->whereNotIn('id', $id);

        return view('admin.managers.edit', ['manager' => $manager, 'drivers' => $drivers, 'driversAll' => $driversAll]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $manager = Manager::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
        ]);


        $manager->name = $request->name;
        $manager->email = $request->email;
        if ($request->password != '') {
            $manager->password = Hash::make($request->password);
        }

        $manager->save();
        Toastr::success('Manager Successfully Updated');
        return redirect()->route('admin.managers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manager = Manager::findOrFail($id);
        $manager->delete();
        return redirect()->route('admin.managers.index');
    }
}
