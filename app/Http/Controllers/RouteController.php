<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{

    public function getReport()
    {
        $selectRoutes = DB::select('select distinct route_num from routes');

        $routes = DB::select('SELECT routes.route_num, 
            routes.stop_sequence_num, route_stop.stop_id, 
            route_stop.route_num, route_stop.stop_sequence_num, 
            stops.id, stops.name
            FROM routes, route_stop, stops
            WHERE ((route_stop.stop_sequence_num = routes.stop_sequence_num
             AND route_stop.route_num = routes.route_num)
             AND (route_stop.stop_id = stops.id)) 
            order by route_stop.stop_sequence_num
        ');

        return view('routeReport', array(
            'selectRoutes' => $selectRoutes,
            'routes' => $routes,
        ));
    }

}
