<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Trolleybus;
use Illuminate\Http\Request;

class TrolleybusController extends Controller
{

    public function index(Request $request)
    {
        $make = $request->input('make');
        $dateFrom = $request->input('date-from');
        $dateTo = $request->input('date-to');
        $plate = $request->input('plate');

        $query = Trolleybus::query();

        if ($make != null) {
            $query->where('make', $make);
        }
        if ($dateFrom != null) {
            $query->where('date', '>=', $dateFrom);
        }
        if ($dateTo != null) {
            $query->where('date', '<=', $dateTo);
        }
        if ($plate != null) {
            $query->where('plate', 'like', "%$plate%");
        }

        $trolleybuses = $query->orderBy('id')->get();
        $drivers = Driver::all();
        $makes = Trolleybus::select('make')->distinct('make')->orderBy('make')->get();

        return view('trolleybuses', array(
            'trolleybuses' => $trolleybuses,
            'drivers' => $drivers,
            'makes' => $makes,
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
            'plate' => 'required|max:6',
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
            'plate' => 'required|max:6',
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
            foreach ($trolleybusDrivers as $trolleybusDriver) {
                if ($driver->id == $trolleybusDriver->id) {
                    unset($drivers[$key]);
                }
            }
        }

        return response()->json($drivers);
    }

    public function getReport(Request $request)
    {
        $makes = Trolleybus::select('make')->distinct('make')->orderBy('make')->get();

        $make = $request->input('make');
        $dateFrom = $request->input('date-from');
        $dateTo = $request->input('date-to');
        $plate = $request->input('plate');

        $query = Trolleybus::query();

        if ($make != null) {
            $query->where('make', $make);
        }
        if ($dateFrom != null) {
            $query->where('date', '>=', $dateFrom);
        }
        if ($dateTo != null) {
            $query->where('date', '<=', $dateTo);
        }
        if ($plate != null) {
            $query->where('plate', 'like', "%$plate%");
        }

        $trolleybuses = $query->with(['drivers' => function ($query) {
            $query->orderBy('id');
        }])->orderBy('id')->get();

        return view('trolleybusReport', array(
            'trolleybuses' => $trolleybuses,
            'makes' => $makes,
        ));
    }

}
