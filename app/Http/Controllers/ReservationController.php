<?php

namespace App\Http\Controllers;

use App\Jobs\ReserveTicket;
use App\Reservation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Movieslots;
use Illuminate\Support\Facades\Auth;
use DB;
class ReservationController extends Controller implements ShouldQueue
{

    //'
    public function CreateReservation($id)
    {
        $queue = new ReserveTicket($id);
        $this->dispatch($queue);
        $movie = Movieslots::where('id',$id)->first()->movie_id;
        return redirect('cinema/'.$movie);
    }
    public function ConfirmReservation()
    {

    }

    public function cancelreservation()
    {

    }

    public function reservation_list()
    {

    }

    /**
     * Reservation List in Blade Template
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewlist(Request $request)
    {
        DB::enableQueryLog(); // Enable query log

        $reserve = Reservation::join('users', 'reservations.user_id', 'users.id')
            ->join('cinemas', 'cinemas.id', 'reservations.cinema_id')
            ->join('movieslots', 'movieslots.id', 'reservations.cinema_id');
         if(Auth::user()->role_id ==2){
             $reserve->where('reservations.user_id',Auth::user()->id);
         }

        $reservations =   $reserve->get();
//        dd(DB::getQueryLog()); // Show results of log

        return view('reservation.list', compact('reservations'));
    }

    public function confrimReservation($id)
    {
        $movie_id = Reservation::where('cinema_id', $id)
            ->update(['is_confirmed' => 1]);
        return redirect()->back();
    }

}
