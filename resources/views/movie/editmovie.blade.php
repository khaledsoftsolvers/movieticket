@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">


            <div class="col-md-12">
                <div class="panel panel-primary panel">
                    <div class="panel-heading">Add Movie</div>
                    <div class="panel-body">
                        <form method="post" action="{{url('/cinema/update/'. $movies->id)}}">
                            @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="moviename"> Movie Name</label>
                                <input type="text" id="moviename" value="{{ $movies->movie_name }}" required name="moviename" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="moviename"> Start date</label>
                                <input type="date" required name="date" value="{{ date('Y-m-d',strtotime($movies->start_datetime)) }}" class="form-control form_date" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success pull-right"> Update Movie </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
