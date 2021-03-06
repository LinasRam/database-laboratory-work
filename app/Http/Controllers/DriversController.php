<?php

namespace App\Http\Controllers;

use App\Driver;
use Illuminate\Http\Request;

class DriversController extends Controller
{

    public function index()
    {
        $drivers = Driver::all();
        $driver = $drivers[0];
        $trolleybuses = $driver->trolleybuses()->get();

        return view('welcome', array(
            'main_driver' => $driver,
            'drivers' => $drivers,
            'trolleybuses' => $trolleybuses,
        ));
    }

    public function postIndex(Request $request)
    {
        $drivers = Driver::all();
        $driverId = $request->get('driver');
        $driver = Driver::find($driverId);
        $trolleybuses = $driver->trolleybuses()->get();

        return view('welcome', array(
            'main_driver' => $driver,
            'drivers' => $drivers,
            'trolleybuses' => $trolleybuses,
        ));
    }

    public function editDriver($id)
    {
        $driver = Driver::find($id);

        return view('editDriver', array(
            'driver' => $driver,
        ));
    }

    public function postEditDriver($id, Request $request)
    {
        $driver = Driver::find($id);

        $current_date = date('Y-m-d');

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_date' => "required|date|before:$current_date",
        ]);

        $driver->first_name = $request->get('first_name');
        $driver->last_name = $request->get('last_name');
        $driver->birth_date = $request->get('birth_date');

        $driver->save();

        return response()->redirectToRoute('drivers');
    }

    public function newDriver()
    {
        return view('newDriver');
    }

    public function postDriver(Request $request)
    {
        $current_date = date('Y-m-d');

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'birth_date' => "required|date|before:$current_date",
        ]);

        $driver = new Driver();

        $driver->first_name = $request->get('first_name');
        $driver->last_name = $request->get('last_name');
        $driver->birth_date = $request->get('birth_date');

        $driver->save();

        return response()->redirectToRoute('drivers');
    }

    public function deleteDriver($id)
    {
        $driver = Driver::find($id);

        $driver->trolleybuses()->detach();
        $driver->delete();

        return response()->redirectToRoute('drivers');
    }

    public function getReport(Request $request)
    {
        $query = Driver::query();

        $driverId = $request->input('driver');
        if ($driverId != null) {
            $query->where('id', $driverId);
        }

        $drivers = $query->with(['trolleybuses' => function ($query) {
            $query->orderBy('id');
        }])->get();

        return view('driverReport', array(
            'drivers' => $drivers,
        ));
    }

    public function getReportForm()
    {
        $names = Driver::orderBy('first_name')->get();

        return view('driverReportForm', array(
            'names' => $names,
        ));
    }

}
