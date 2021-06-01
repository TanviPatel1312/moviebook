<?php

namespace App\Http\Controllers;

use App\Models\Caste;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\MovieCasts;

class MovieCastsController extends Controller
{
    public function allCastMovie()
    {
        return MovieCasts::join('castes','castes.id','movie_casts.c_id')->join('movies','movies.id','movie_casts.m_id')->get();
    }
    public function saveCastMovie(Request $request)
    {
        $movieCast = new MovieCasts();
        $movieCast->c_id = $request->c_id;
        $movieCast->m_id = $request->m_id;

        $movieCast->save();
    }
    public function editCastMovie($id)
    {
        $movieCast = MovieCasts::find($id);
        return response()->json($movieCast);
    }


    public function update()
    {

        $movieCast = MovieCasts::find(request()->id);
        $movieCast->c_id = request()->c_id;
        $movieCast->m_id = request()->m_id;
        $movieCast->update();
    }


    public function deleteCastMovie($id)
    {
        $movieCast =MovieCasts::find($id)->delete();
    }

public function getAllMovieCast($id)
    {
        return MovieCasts::join('castes','castes.id','movie_casts.c_id')->
            join('movies','movies.id','movie_casts.m_id')->where('movie_casts.m_id',$id)->get();
    }
    public function getmovie()
    {
        $data = Movie::get();

        return response()->json($data);
    }
    public function getmoviebyid($id)
    {
        return Movie::where("id",$id)->get();
    }
    public function getcast()
    {
        $data = Caste::get();

        return response()->json($data);
    }
    public function getcastbyid($id)
    {
        return MovieCasts::select("castes.*")
            ->join("castes","castes.id","movie_casts.c_id")
            ->where("movie_casts.m_id",$id)
            ->get();
    }
    public function getAllMovieIds($id)
    {
//        dd($id);
        return MovieCasts::select("caste.*")
            ->join("caste","caste.id","movie_casts.c_id")
            ->where("movie_casts.m_id",$id)
            ->get();
    }


}
