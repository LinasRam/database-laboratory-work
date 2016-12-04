@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Kriterijai</h3>
                    </div>
                    <div class="panel-body">
                        <form method="get">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="make">Marke:</label>
                                    <select class="form-control" id="make" name="make">
                                        <option value="">-Marke-</option>
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
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">"Troleibusas-Vairuotojas" ataskaita</h3>
                    </div>
                    <div class="panel-body">
                        @php ($trolleybusCount = 0)
                        @foreach($trolleybuses as $trolleybus)
                            @php
                                $driverCount = 0;
                                $trolleybusCount++;
                            @endphp
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style="padding-bottom: 30px;">
                                            <div class="col-md-3">
                                                <p><strong>Troleibuso ID: {{ $trolleybus->id }}</strong></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p><strong>Marke: {{ $trolleybus->make }}</strong></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p><strong>Pagaminimo data: {{ $trolleybus->date }}</strong></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p><strong>Valstybinis numeris: {{ $trolleybus->plate }}</strong></p>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Vairuotojo ID</th>
                                                    <th>Vardas</th>
                                                    <th>Pavarde</th>
                                                    <th>Gimimo data</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($trolleybus->drivers as $driver)
                                                    @php ($driverCount++)
                                                    <tr>
                                                        <td>{{ $driver->id }}</td>
                                                        <td>{{ $driver->first_name }}</td>
                                                        <td>{{ $driver->last_name }}</td>
                                                        <td>{{ $driver->birth_date }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="panel-footer" style="padding-bottom: 30px;">
                                            <div class="col-md-3">
                                                <p><strong>Is viso vairuotoju: {{ $driverCount }}</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="panel-footer" style="padding-bottom: 30px;">
                        <div class="col-md-3">
                            <p><strong>Is viso troleibusu: {{ $trolleybusCount }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection