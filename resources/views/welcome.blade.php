@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Pasirinkite vairuotoja</h3>
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
                            <button class="btn btn-default" type="submit">Rodyti informacija</button>
                            <button type="button" class="btn btn-danger pull-right" style="margin-left: 3px;"
                                    data-toggle="modal" data-target="#deleteModal">Istrinti
                            </button>
                            <a id="edit-button" href="{{ route('editDriver', $main_driver->id) }}"
                               class="btn btn-warning pull-right">Redaguoti</a>
                            <br>
                            <a href="{{ route('newDriver') }}" class="btn btn-primary" style="margin-top: 42px;">Ivesti
                                nauja</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Informacija apie vairuotoja</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Vairuotojo ID: </strong>{{ $main_driver->id }}</li>
                            <li class="list-group-item"><strong>Vardas: </strong>{{ $main_driver->first_name }}</li>
                            <li class="list-group-item"><strong>Pavarde: </strong>{{ $main_driver->last_name }}</li>
                            <li class="list-group-item"><strong>Gimimo data: </strong>{{ $main_driver->birth_date }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
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
                                <th>Marke</th>
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
                                        <button type="button" class="detach-button btn btn-warning pull-right"
                                                data-toggle="modal" data-target="#detachModal"
                                                data-id="{{ $trolleybus->id }}">Atskirti troleibusa
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

    <!-- Modal -->
    <div id="deleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Ar tikrai norite istrinti si vairuotja?</h4>
                </div>
                <div class="modal-body">
                    <p>Vairuotojas bus istrintas negriztamai.</p>
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
                    <h4 class="modal-title">Ar tikrai norite atskirti si troleibusa nuo vairuotojo?</h4>
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
        $("#driver").change(function () {
            var id = $("#driver option:selected").attr("value");
            var editUrl = "/driver/" + id + "/edit";
            var deleteUrl = "/driver/" + id + "/delete";

            $("#edit-button").attr("href", editUrl);
            $("#delete-button").attr("href", deleteUrl);
        });

        $(".detach-button").click(function () {
            var trolleybusId = $(this).data("id");
            var driverId = "{{ $main_driver->id }}";
            var detachUrl = "trolleybus/" + trolleybusId + "/detach-driver/" + driverId;

            $("#detach-button").attr("href", detachUrl);
        });
    </script>
@endsection