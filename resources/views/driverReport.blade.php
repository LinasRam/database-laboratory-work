@extends('layouts.report')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">"Vairuotojas-Troleibusas" ataskaita</h3>
                    </div>
                    <div class="panel-body">
                        @php ($driverCount = 0)
                        @foreach($drivers as $driver)
                            @php
                                $trolleybusCount = 0;
                                $driverCount++;
                            @endphp
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style="padding-bottom: 30px;">
                                            <div class="col-md-3">
                                                <p><strong>Vairuotojo ID: {{ $driver->id }}</strong></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p><strong>Vardas: {{ $driver->first_name }}</strong></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p><strong>Pavardė: {{ $driver->last_name }}</strong></p>
                                            </div>
                                            <div class="col-md-3">
                                                <p><strong>Gimimo data: {{ $driver->birth_date }}</strong></p>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Troleibuso ID</th>
                                                    <th>Markė</th>
                                                    <th>Pagaminimo data</th>
                                                    <th>Valstybinis numeris</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($driver->trolleybuses as $trolleybus)
                                                    @php ($trolleybusCount++)
                                                    <tr>
                                                        <td>{{ $trolleybus->id }}</td>
                                                        <td>{{ $trolleybus->make }}</td>
                                                        <td>{{ $trolleybus->date }}</td>
                                                        <td>{{ $trolleybus->plate }}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="panel-footer" style="padding-bottom: 30px;">
                                            <div class="col-md-3">
                                                <p><strong>Iš viso troleibusų: {{ $trolleybusCount }}</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="panel-footer" style="padding-bottom: 30px;">
                        <div class="col-md-3">
                            <p><strong>Iš viso vairuotojų: {{ $driverCount }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection