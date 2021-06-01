<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Moviepost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function allMovie()
    {
        $movie= Movie::all();
        return response()->json($movie);
    }


    public function saveMovie()
    {
        $movie = new Movie();
        $movie->title = request()->title;
        $movie->overview = request()->overview;
        $movie->releaseyear = request()->releaseyear;
        $movie->runtime = request()->runtime;
        $movie->save();
    }


    public function editMovie($id)
    {
        $movie = Movie::find($id);
        return response()->json($movie);
    }


    public function update()
    {

        $movie = Movie::find(request()->id);
        $movie->title = request()->title;
        $movie->overview = request()->overview;
        $movie->releaseyear = request()->releaseyear;
        $movie->runtime = request()->runtime;
        $movie->update();
    }


    public function deleteMovie($id)
    {
        $movie =Movie::find($id)->delete();
    }
    public function getSearchMovie($str){
        return Moviepost::select('movies.*')
            ->join('cities', 'movieposts.city_id', '=', 'cities.id')
            ->join('theatres', 'movieposts.t_id', '=', 'theatres.id')
            ->join('movies', 'movieposts.m_id', '=', 'movies.id')
            ->where("movies.title" ,'LIKE', "%{$str}%")
            ->orWhere('cities.cityname', 'LIKE', "%{$str}%")
            ->orWhere('theatres.name', 'LIKE', "%{$str}%")
            ->distinct()
            ->get();
    }
}
