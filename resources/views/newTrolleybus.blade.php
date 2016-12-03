@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Naujas troleibusas</h3>
                </div>
                <div class="panel-body">
                    <form action="{{ route('postTrolleybus') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="make">Marke</label>
                            <input id="make" class="form-control" name="make" type="text">
                        </div>
                        <div class="form-group">
                            <label for="date">Pagaminimo data</label>
                            <input id="date" class="form-control" name="date" type="text">
                        </div>
                        <div class="form-group">
                            <label for="plate">Valstybinis numeris</label>
                            <input id="plate" class="form-control" name="plate" type="text">
                        </div>
                        <button class="btn btn-primary" type="submit">Ivesti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection