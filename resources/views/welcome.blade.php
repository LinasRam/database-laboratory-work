@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Pasirinkite vairuotoją</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('postDrivers') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="driver">Vairuotojas:</label>
                                <select class="form-control" id="driver" name="driver">
                                    @foreach($drivers as $driver)
                                        @if($driver->id == $main_driver->id)
                                            <option selected
                                                    value="{{ $driver->id }}">{{ $driver->first_name . " " . $driver->last_name }}</option>
                                        @else
                                            <option value="{{ $driver->id }}">{{ $driver->first_name . " " . $driver->last_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit">Rodyti informaciją</button>
                            <a href="{{ route('newDriver') }}" class="btn btn-default pull-right" style="">Įvesti
                                naują</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Informacija apie vairuotoją</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('postEditDriver', $main_driver->id) }}" method="post">
                            {{ csrf_field() }}
                            <ul class="list-group">
                                <li class="list-group-item form-group"><label>Vairuotojo ID:</label><input disabled
                                                                                                           class="form-control"
                                                                                                           type="text"
                                                                                                           value="{{ $main_driver->id }}">
                                </li>
                                <li class="list-group-item form-group"><label for="first_name">Vardas:</label><input
                                            id="first_name" name="first_name" class="form-control"
                                            type="text"
                                            value="{{ $main_driver->first_name }}">
                                </li>
                                <li class="list-group-item form-group"><label for="last_name">Pavardė:</label><input
                                            id="last_name" name="last_name" class="form-control"
                                            type="text"
                                            value="{{ $main_driver->last_name }}">
                                </li>
                                <li class="list-group-item form-group"><label for="birth_date">Gimimo
                                        data:</label><input
                                            id="birth_date" name="birth_date" class="form-control" type="text"
                                            value="{{ $main_driver->birth_date }}"></li>
                            </ul>
                            <button type="submit" id="edit-button" href="{{ route('editDriver', $main_driver->id) }}"
                                    class="btn btn-warning" style="margin-bottom: 25px;">Redaguoti
                            </button>
                            <button type="button" class="btn btn-danger pull-right" style="margin-left: 3px;"
                                    data-toggle="modal" data-target="#deleteModal">Ištrinti
                            </button>
                        </form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Vairuojami troleibusai</h3>
                                    </div>
                                    <div class="panel-body">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Troleibuso ID</th>
                                                <th>Markė</th>
                                                <th>Pagaminimo data</th>
                                                <th>Valstybinis numeris</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($trolleybuses as $trolleybus)
                                                <tr>
                                                    <td>{{ $trolleybus->id }}</td>
                                                    <td>{{ $trolleybus->make }}</td>
                                                    <td>{{ $trolleybus->date }}</td>
                                                    <td>{{ $trolleybus->plate }}</td>
                                                    <td>
                                                        <button type="button"
                                                                class="detach-button btn btn-warning pull-right"
                                                                data-toggle="modal" data-target="#detachModal"
                                                                data-id="{{ $trolleybus->id }}">Atskirti troleibusą
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ar tikrai norite ištrinti šį vairuotją?</h4>
                </div>
                <div class="modal-body">
                    <p>Vairuotojas bus ištrintas negrįžtamai.</p>
                </div>
                <div class="modal-footer">
                    <a id="delete-button" href="{{ route('deleteDriver', $main_driver->id) }}" type="button"
                       class="btn btn-danger">Taip</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ne</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div id="detachModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ar tikrai norite atskirti šį troleibusą nuo vairuotojo?</h4>
                </div>
                <div class="modal-body">
                    <p>Troleibusas bus atskirtas.</p>
                </div>
                <div class="modal-footer">
                    <a id="detach-button" href="#" type="button"
                       class="btn btn-warning">Taip</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ne</button>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(".detach-button").click(function () {
            var trolleybusId = $(this).data("id");
            var driverId = "{{ $main_driver->id }}";
            var detachUrl = "trolleybus/" + trolleybusId + "/detach-driver/" + driverId;

            $("#detach-button").attr("href", detachUrl);
        });
    </script>
@endsection