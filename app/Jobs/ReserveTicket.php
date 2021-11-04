<?php

namespace App\Jobs;

use App\Cinema;
use App\Movieslots;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ReserveTicket implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $id;
    protected $slots            = 0;
    protected $available        = 0;
    protected $is_exists        = 0;
    protected $movie_name;
    protected $slot;
    protected $movie_date       =   "";
    protected $user_id          =   0;
    protected $user_email       =   "";
    protected $movie_id         =   0;
    protected $movie_time       =   "";
    protected $seat_available   =   true;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        //
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //

        $this->process($this->id);


    }
    protected function process($id){
        $this->movie_slots($id);
        $this->movie_data();
        $this->set_current_user();
        $this->is_exists();
        $this->is_seat_available();
        $this->add_reservation();
    }

    /**
     * Movie Slot
     * @param $id
     */
    protected function movie_slots($id){
        $slot            = Movieslots::where('id',$id)->first();
        $this->slot      = $slot;
        $this->slots     = $slot->number_of_seats;
        $this->available = $slot->available_slot;
        $this->movie_time = $slot->time;

    }

    /**
     * Movie Data
     */
    protected function movie_data(){
        $movie_id         = $this->slot->movie_id;
        $movie            = Cinema::where('id',$movie_id)->first();
        $this->movie_name = $movie->movie_name;
        $this->movie_date = $movie->start_datetime;
        $this->movie_id    = $movie_id;
    }

    /**
     * Current User
     */
    protected function set_current_user(){
        $user             = Auth::user();
        $this->user_id    = $user->id;
        $this->user_email = $user->email;
    }

    protected function is_exists(){
       $this->is_exists = Reservation::where('cinema_id',$this->movie_id)
           ->where('movie_time',$this->movie_time)
           ->where('user_id',$this->user_id)
           ->count();
    }

    protected function is_seat_available(){

        if($this->slots > $this->available){
            $this->available =  $this->available+1;
            $this->seat_available = true;
        }
        else{
            $this->seat_available = false;
        }
    }
    protected function add_reservation(){
        if($this->is_exists == 0 && $this->seat_available === true ){
            $data=[
                'user_id'       => $this->user_id,
                'user_email'    => $this->user_email,
                'cinema_id'     => $this->movie_id,
                'movie_name'    => $this->movie_name,
                'movie_date'    => $this->movie_date,
                'movie_time'    => $this->movie_time,
                'is_confirmed'  =>  0,
                'is_cancelled'  =>  0,
                'is_deleted'    =>  0,
                'created_at'    => Carbon::now()

            ];
            Reservation::insert($data);
            Movieslots::where('movie_id',$this->movie_id)->where('time',$this->movie_time)->update(['available_slot'=>$this->available]);
        }
    }
}
