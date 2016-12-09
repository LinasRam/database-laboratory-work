@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Kriterijai troleibusų ataskaitai</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('trolleybusReport') }}" method="post">
                            {{ csrf_field() }}
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="make">Markė:</label>
                                    <select class="form-control" id="make" name="make">
                                        <option value="">-Markė-</option>
                                        @foreach($makes as $make)
                                            <option value="{{ $make->make }}">{{ $make->make }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date-from">Pagaminimo data nuo:</label>
                                    <input id="date-from" name="date-from" class="form-control" type="date">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="date-to">Pagaminimo data iki:</label>
                                    <input id="date-to" name="date-to" class="form-control" type="date">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="plate">Valstybinis numeris:</label>
                                    <input id="plate" name="plate" class="form-control" type="text">
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