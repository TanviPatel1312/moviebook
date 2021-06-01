<?php

namespace App\Http\Controllers;

use App\Models\bookmovie;
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
        }else{
            $date = $request->time;
        }
        return bookmovie::select('bookmovies.seats','bookmovies.username','bookmovies.showtime','bookmovies.showtimedate')
            ->where("bookmovies.username",$request->username)
            ->where("bookmovies.showtime",'LIKE',"%{$request->showtime}%")
            ->where("bookmovies.showtimedate",$date)
            ->get();
    }
}
