<?php

namespace App\Http\Controllers;

use App\Models\bookmovie;
use Illuminate\Http\Request;

class BookMovieController extends Controller
{
    public function bookmovie()
    {
        $movie= bookmovie::all();
        return response()->json($movie);
    }


    public function savebook()
    {
        $movie = new bookmovie();
        $movie->Name = request()->Name;
        $movie->showtime = request()->showtime;
        $movie->seats = request()->seats;
        $movie->city = request()->city;
        $movie->save();
    }
}
