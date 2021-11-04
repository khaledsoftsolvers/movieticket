@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">


            <div class="col-md-12">
                <div class="panel panel-primary panel">
                    <div class="panel-heading">Add Movie</div>
                    <div class="panel-body">
                        <form method="post" action="{{route('movie.add')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="moviename"> Movie Name</label>
                                <input type="text" id="moviename" required name="moviename" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="moviename"> Start date</label>
                                <input type="date" required name="date" class="form-control form_date" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right"> Add </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <table class="table table-responsive table-bordered table-striped" >
                    <thead>
                        <tr>
                            <th>Movie Name</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($movies as $movie)
                        <tr>
                            <th> <a href="{{ url('cinema/'.$movie->id) }}"> {{ $movie->movie_name }} </a></th>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
