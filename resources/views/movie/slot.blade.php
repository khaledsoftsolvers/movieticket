@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="panel panel-primary panel">
                    <div class="panel-body">
                            <div class="form-group">
                                <label for="moviename"> Movie Name</label>
                                <input type="text" disabled id="moviename" value="{{ $movie->movie_name }}" required name="moviename" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="moviename"> Start date</label>
                                <input type="text" disabled required  value="{{ $movie->start_datetime }}"  name="date" class="form-control form_date" />
                            </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <hr />
            <div class="clearfix"></div>
                @if(Auth::user()->role == 1)
                    <div class="col-md-12">
                        <div class="panel panel-primary panel">
                            <div class="panel-heading">Add Movie</div>
                            <div class="panel-body">
                                <form method="post" action="{{route('movie.addslots')}}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="movieid" value="{{ $movie->id }}" />
                                    <div class="form-group col-md-6">
                                        <label for="moviename"> Time </label>
                                        <input type="time" required    name="date" class="form-control " />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="time"> Slot </label>
                                        <input type="number" required    name="slot" class="form-control " />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <button type="submit" class="btn btn-primary pull-right"> Add </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            <div class="col-md-12">
                <div class="panel panel-primary panel">
                    <div class="panel-heading">Add Movie</div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Time</th>
                                <th>Allocated Slots</th>
                                <th> Remaining </th>
                                @if(Auth::user()->role_id)
                                    <th>Action</th>
                                @endif
                            </tr>
                            @foreach($slots as $slot)
                            <tr>
                                <td>{{ $slot->time }}</td>
                                <td>{{ $slot->number_of_seats }}</td>
                                <td>{{ $slot->number_of_seats - $slot->available_slot }}</td>
                                @if(Auth::user()->role_id)
                                    <td><a href="{{url('cinema/reserve/'.$slot->id)}}">Reserve Now</a></td>
                                @endif
                            </tr>
                            @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
