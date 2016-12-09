@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Vairuotojų ataskaitos kriterijai</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('driverReport') }}" method="post">
                            {{ csrf_field() }}
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
    </div>
@endsection