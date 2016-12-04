@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Marsrutas</h3>
                    </div>
                    <div class="panel-body">
                        <form method="get">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label for="route">Marsrutas</label>
                                    <select class="form-control" id="route" name="route">
                                        @foreach($selectRoutes as $selectRoute)
                                            <option value="{{ $selectRoute->route_num }}">{{ $selectRoute->route_num }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <label style="visibility: hidden">s</label>
                                <button class="btn btn-default" type="submit">Rodyti</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="padding-bottom: 30px;">
                        <h3 class="panel-title">Marsrutas Nr. {{ $selectRoutes[0]->route_num }}</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Stoteles eiles nr.</th>
                                <th>Stoteles pavadinimas</th>
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
                            <p><strong>Is viso stoteliu: {{ $stopCount }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection