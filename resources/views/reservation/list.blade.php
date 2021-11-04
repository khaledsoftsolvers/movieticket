@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-responsive table-bordered table-striped">
                    <thead>
                        <tr>
                            <th> Viewer Name </th>
                            <th> Movie Name </th>
                            <th> Reservation Date </th>
                            <th> Start Time</th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $res)
                            <tr>
                                <th> {{ $res->name }}</th>
                                <th> {{ $res->movie_name }}</th>
                                <th> {{ $res->movie_date }}</th>
                                <th> {{ $res->movie_time }}</th>

                                @if ($res->is_confirmed == 0)
                                    <th> <a href="{{ url('/reservation/movie/confrimed/' . $res->cinema_id) }}"><button
                                                class="btn btn-success">Confrim</button></a></th>
                                @else
                                    <th> <a href="#"><button class="btn btn-secondary disabled">Booked</button></a></th>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
