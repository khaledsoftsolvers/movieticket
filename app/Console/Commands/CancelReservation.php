<?php

namespace App\Console\Commands;

use App\Reservation;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CancelReservation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reserve:cancel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Every ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reservations = Reservation::where('created_at','<',Carbon::now()->subMinute(15))->where('is_confirmed',0)->get();
        foreach($reservations as $reservation){
            Reservation::where('id',$reservation->id)->update(['cancelled'=>1]);
        }
    }
}
