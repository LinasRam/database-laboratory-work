@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Maršrutas</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('routeReport') }}" method="post">
                            {{ csrf_field() }}
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label for="route">Maršrutas</label>
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
    </div>
@endsection