<?php

namespace App\Http\Controllers;

use App\Models\Moviepost;
use App\Models\Theatres;
use App\Models\Movie;
use Illuminate\Http\Request;

class MoviePostController extends Controller
{
    public function getAllMoviePost($id)
    {
        return Moviepost::join('theatres','theatres.id','movieposts.t_id')->where('movieposts.m_id',$id)->get();
    }
    public function getMovie()
    {
        $data = Movie::get();

        return response()->json($data);
    }
    public function getTheatre()
    {
        $data = Theatres::get();

        return response()->json($data);
    }
}
