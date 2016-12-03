@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Paieska</h3>
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
                                <button class="btn btn-default" type="submit">Ieskoti</button>
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
                        <h3 class="panel-title">Visi troleibusai</h3>
                        <a href="{{ route('newTrolleybus') }}" class="btn btn-primary pull-right">Ivesti nauja</a>
                        <div class="clearfix"></div>
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
                                        <button type="button" class="delete-button btn btn-danger pull-right"
                                                style="margin-left: 3px;"
                                                data-toggle="modal" data-target="#deleteModal"
                                                data-id="{{ $trolleybus->id }}">Istrinti
                                        </button>
                                        <a id="edit-button" href="{{ route('editTrolleybus', $trolleybus->id) }}"
                                           class="btn btn-warning pull-right" style="margin-left: 3px;">Redaguoti</a>
                                        <button type="button" class="attach-button btn btn-default pull-right"
                                                style="margin-left: 3px;"
                                                data-toggle="modal" data-target="#attachModal"
                                                data-id="{{ $trolleybus->id }}">Priskirti vairuotoja
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
                    <h4 class="modal-title">Ar tikrai norite istrinti si troleibusa?</h4>
                </div>
                <div class="modal-body">
                    <p>Troleibusas bus istrintas negriztamai.</p>
                </div>
                <div class="modal-footer">
                    <a id="delete-button" href="#" type="button" class="btn btn-danger">Taip</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Ne</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div id="attachModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Vairuotojo priskyrimas</h4>
                </div>
                <div class="modal-body">
                    <form id="attach-form" action="#" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="driver">Vairuotojas:</label>
                            <select class="form-control" id="driver" name="driver">
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->first_name . " " . $driver->last_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-default" type="submit">Priskirti vairuotoja</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(".delete-button").click(function () {
            var id = $(this).data("id");
            var deleteUrl = "/trolleybus/" + id + "/delete";

            $("#delete-button").attr("href", deleteUrl);
        });

        $(".attach-button").click(function () {
            var id = $(this).data("id");
            var postUrl = "/trolleybus/" + id + "/attach-driver";

            $("#attach-form").attr("action", postUrl);

            $.ajax({
                type: 'GET',
                url: '/trolleybus/' + id + '/available-drivers',
                dataType: 'json',
                success: function (data) {
                    $("#attach-form select").empty();
                    $.each(data, function (i, val) {
                        console.log("ok");
                        $("#attach-form select").append("<option value='" + val.id + "'>" + val.first_name + " " + val.last_name + "</option>");
                    });
                }
            });
        });
    </script>
@endsection