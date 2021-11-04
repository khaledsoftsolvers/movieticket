<?php

namespace App\Http\Controllers;
use App\Cinema;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Movieslots;
use http\Url;
class CinemaController extends Controller
{
    //
    public function addNew(Request $request){
     $validation=   Validator::make($request->all(), [
            'moviename' => 'required',
            'date'      => 'required|date',
        ]);
     $data =[];

     if($validation->fails()){
          redirect()->back()->withErrors('error',$validation);
     }
     else{
         $name = $request->input('moviename');
         $date = $request->input('date');
         $date = date('Y-m-d',strtotime($date));
         try{
             $movie = Cinema::create(['movie_name'=>$name,'start_datetime'=>$date]);

            return redirect('cinema/'.$movie->id);
         }catch (\Exception $e){
             $data['data']  = "";
            return redirect()->back()->withErrors('error',$e->getMessage());
         }

     }
    }
    public function newslot(Request $request){
            $validation   =   Validator::make($request->all(), [
                'movieid' => 'required',
                'date'    => 'required',
                'slot'    => 'required|integer',
            ]);

            $movieid = $request->input('movieid');
            $time    = $request->input('date');
            $slots   = $request->input('slot');
            $data    = [
                      'movie_id'         =>  $movieid,
                      'time'             =>  $time,
                      'number_of_seats'  =>  $slots
                    ];
            Movieslots::insert($data);
            return redirect('cinema/'.$movieid);

        }

    /**
     * Add Slot Form
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addslots($id){
        $movie = Cinema::find($id);
        $slots = Movieslots::where('movie_id',$id)->get();
        return view('movie.slot',compact('movie','slots'));
    }
    public function edit(){

    }
    public function delete(){

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function movieform(Request $request){
        $movies = Cinema::all();
        return view('movie.form',compact('movies'));
    }
    /**
     * View Movies in Blade
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function viewlist(){
        $movies = Cinema::all();
        return view('movie.list',compact('movies'));
    }

    /**
     * Movie Edit Blade
     */

    public function  EditMovieList($id){
        $movies = Cinema::find($id);
        return view('movie.editmovie',compact('movies'));
    }

     /**
     * Movie Update 
     */

    public function updateMovieList(Request $request, $id){
        $validation=   Validator::make($request->all(), [
            'moviename' => 'required',
            'date'      => 'required|date',
        ]);
     $data =[];

     if($validation->fails()){
          redirect()->back()->withErrors('error',$validation);
     }
     else{
         $name = $request->input('moviename');
         $date = $request->input('date');
         $date = date('Y-m-d',strtotime($date));
         try{
             
             $movie = Cinema::where('id',$id)
                             ->update(['movie_name'=>$name, 'start_datetime'=>$date]);
            return redirect('cinema/'.$movie->id)->with('success', 'Movie Updated');
         }catch (\Exception $e){
             $data['data']  = "";
            return redirect()->back()->withErrors('error',$e->getMessage());
         }

     }
    }


}
