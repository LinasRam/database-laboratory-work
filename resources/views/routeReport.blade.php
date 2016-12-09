@extends('layouts.report')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="padding-bottom: 30px;">
                        <h3 class="panel-title">Maršruto Nr. {{ $selectRoutes[0]->route_num }}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Stotelės eilės nr.</th>
                                <th>Stotelės pavadinimas</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php ($stopCount = 0)
                            @foreach($routes as $route)
                                @php ($stopCount++)
                                <tr>
                                    <td>{{ $route->stop_sequence_num }}</td>
                                    <td>{{ $route->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="panel-footer" style="padding-bottom: 30px;">
                        <div class="col-md-3">
                            <p><strong>Iš viso stotelių: {{ $stopCount }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection