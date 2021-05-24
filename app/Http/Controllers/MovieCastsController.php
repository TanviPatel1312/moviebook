<?php

namespace App\Http\Controllers;

use App\Models\Caste;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\MovieCasts;

class MovieCastsController extends Controller
{
    public function index()
    {
        return view("index");
    }
    public function store(Request $request)
    {
        $movieCast = new MovieCasts();
        $movieCast->c_id = $request->c_id;
        $movieCast->m_id = $request->m_id;
        $movieCast->save();
        return $movieCast;
    }
    public function edit(MovieCasts $movieCasts, $id)
    {
        return MovieCasts::find($id);
    }
    public function update(Request $request, MovieCasts $movieCasts, $id)
    {
        $movieCasts = MovieCasts::find($id);
        if ($movieCasts) {
            $movieCast = new MovieCasts();
            $movieCast->c_id = $request->c_id;
            $movieCast->m_id = $request->m_id;
            $movieCast->save();
            return $movieCast;
        }
        return "Not Found!";
    }
    public function destroy(MovieCasts $movieCasts, $id)
    {
        $movieCasts = MovieCasts::find($id);
        if ($movieCasts) {
            $movieCasts->delete();
            return " Successfully deleted";
        }

    }
    public function getAllMovieCast($id)
    {
        return MovieCasts::join('castes','castes.id','movie_casts.c_id')->where('movie_casts.m_id',$id)->get();
    }
    public function getmovie()
    {
        $data = Movie::get();

        return response()->json($data);
    }
    public function getcast()
    {
        $data = Caste::get();

        return response()->json($data);
    }
}
