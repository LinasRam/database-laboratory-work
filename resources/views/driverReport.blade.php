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
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label for="driver">Vairuotojas</label>
                                    <select class="form-control" id="driver" name="driver">
                                        <option value="">-Vairuotojas-</option>
                                        @foreach($names as $name)
                                            <option value="{{ $name->id }}">{{ $name->first_name . " " . $name->last_name }}</option>
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
                                                <p><strong>Pavarde: {{ $driver->last_name }}</strong></p>
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
                                                    <th>Marke</th>
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
                                                <p><strong>Is viso troleibusu: {{ $trolleybusCount }}</strong></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="panel-footer" style="padding-bottom: 30px;">
                        <div class="col-md-3">
                            <p><strong>Is viso vairuotoju: {{ $driverCount }}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection