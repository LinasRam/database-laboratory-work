<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Trolleybus;
use Illuminate\Http\Request;

class TrolleybusController extends Controller
{

    public function index()
    {
        $trolleybuses = Trolleybus::all();
        $drivers = Driver::all();

        return view('trolleybuses', array(
            'trolleybuses' => $trolleybuses,
            'drivers' => $drivers,
        ));
    }

    public function newTrolleybus()
    {
        return view('newTrolleybus');
    }

    public function postTrolleybus(Request $request)
    {
        $this->validate($request, [
            'make' => 'required',
            'date' => 'required|date',
            'plate' => 'required',
        ]);

        $trolleybus = new Trolleybus();

        $trolleybus->make = $request->get('make');
        $trolleybus->date = $request->get('date');
        $trolleybus->plate = $request->get('plate');

        $trolleybus->save();

        return response()->redirectToRoute('trolleybuses');
    }

    public function deleteTrolleybus($id)
    {
        $trolleybus = Trolleybus::find($id);

        $trolleybus->drivers()->detach();
        $trolleybus->delete();

        return response()->redirectToRoute('trolleybuses');
    }

    public function editTrolleybus($id)
    {
        $trolleybus = Trolleybus::find($id);

        return view('editTrolleybus', array(
            'trolleybus' => $trolleybus,
        ));
    }

    public function postEditTrolleybus($id, Request $request)
    {
        $trolleybus = Trolleybus::find($id);

        $this->validate($request, [
            'make' => 'required',
            'date' => 'required|date',
            'plate' => 'required',
        ]);

        $trolleybus->make = $request->get('make');
        $trolleybus->date = $request->get('date');
        $trolleybus->plate = $request->get('plate');

        $trolleybus->save();

        return response()->redirectToRoute('trolleybuses');
    }

    public function attachDriver($id, Request $request)
    {
        $trolleybus = Trolleybus::find($id);

        $trolleybus->drivers()->attach($request->get('driver'));

        return response()->redirectToRoute('trolleybuses');
    }

    public function detachDriver($id, $driverId)
    {
        $trolleybus = Trolleybus::find($id);

        $trolleybus->drivers()->detach($driverId);

        return response()->redirectToRoute('drivers');
    }

    public function getTrolleybusAvailableDrivers($id)
    {
        $trolleybusDrivers = Trolleybus::find($id)->drivers()->get();
        $drivers = Driver::all();

        foreach ($drivers as $key => $driver) {
            foreach ($trolleybusDrivers as $trolleybusDriver){
                if ($driver->id == $trolleybusDriver->id){
                    unset($drivers[$key]);
                }
            }
        }

        return response()->json($drivers);
    }

}
