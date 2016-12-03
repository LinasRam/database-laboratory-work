@extends('layouts.main')

@section('content')
    <div class="container">
        @if($errors->all())
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li style="color: red;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Naujas vairuotojas</h3>
                </div>
                <div class="panel-body">
                    <form action="{{ route('postDriver') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="first_name">Vardas</label>
                            <input id="first_name" class="form-control" name="first_name" type="text">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Pavarde</label>
                            <input id="last_name" class="form-control" name="last_name" type="text">
                        </div>
                        <div class="form-group">
                            <label for="birth_date">Gimimo data</label>
                            <input id="birth_date" class="form-control" name="birth_date" type="date">
                        </div>
                        <button class="btn btn-primary" type="submit">Ivesti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection