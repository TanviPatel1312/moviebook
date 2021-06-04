<?php

namespace App\Http\Controllers;

use App\Models\bookmovie;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookMovieController extends Controller
{
    public function bookmovie()
    {
        $bookmovie= bookmovie::all();
        return response()->json($bookmovie);
    }
    public function savebook(Request $request)
    {
        $bookmovie = new bookmovie();
        $bookmovie->username = $request->username;
        $bookmovie->showtime = request()->showtime;
        $bookmovie->seats = implode('|', $request->seats);
        $bookmovie->showtimedate = request()->showtimedate;
        $bookmovie->save();
        return $bookmovie;
    }
    public function getSeats(Request $request){

        if($request->time == ''){
            $date = date("Y-m-d", strtotime(Carbon::now()));
        }elseif ($request->time == ''){

          $time = time("HH:MM:SS XM ", strtotime(Carbon::now()));
        }
        else{
            $time=$request->time;
            $date = $request->time;
        }

        return bookmovie::select('bookmovies.seats','bookmovies.username','bookmovies.showtime','bookmovies.showtimedate')
            ->where("bookmovies.username",$request->username)
            ->where("bookmovies.showtime",'LIKE',$time)
            ->where("bookmovies.showtimedate",$date)
            ->get();
    }
    public function getMovie()
    {
        $data = Movie::get();

        return response()->json($data);
    }
    public function getMoviebyid($id)
    {
        return Movie::where("id",$id)->get();
    }
}
