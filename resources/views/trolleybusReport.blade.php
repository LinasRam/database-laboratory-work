@extends('layouts.report')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Troleibusų ataskaita</h3>
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
                                                <p><strong>Markė: {{ $trolleybus->make }}</strong></p>
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
                                                    <th>Pavardė</th>
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
                                                <p><strong>Iš viso vairuotojų: {{ $driverCount }}</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="panel-footer" style="padding-bottom: 30px;">
                        <div class="col-md-3">
                            <p><strong>Iš viso troleibusų: {{ $trolleybusCount }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
