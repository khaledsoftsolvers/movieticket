@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <table class="table table-responsive table-bordered table-striped">
                    <thead>
                        <tr>
                            <th> Movie Name</th>
                            <th> Action </th>
                            @if (Auth::user()->role_id == 1)
                                <th> Edit </th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movies as $movie)
                            <tr>
                                <td><a href="{{ url('cinema/' . $movie->id) }}"> {{ $movie->movie_name }} </a></td>
                                <td><a class="btn btn-primary" href="{{ url('cinema/' . $movie->id) }}"> Book Now </a>
                                </td>
                                @if (Auth::user()->role_id == 1)
                                    <td><a class="btn btn-warning" href="{{ url('cinema/edit/' . $movie->id) }}"> Edit
                                            Movie
                                        </a></td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
