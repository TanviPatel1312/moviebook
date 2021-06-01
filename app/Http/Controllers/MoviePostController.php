<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\Moviepost;
use App\Models\Theatres;
use App\Models\Movie;
use Illuminate\Http\Request;

class MoviePostController extends Controller
{
    public function allMoviePost()
    {
        return Moviepost::join('theatres','theatres.id','movieposts.t_id')
            ->join('movies','movies.id','movieposts.m_id')
            ->join('cities','cities.id','movieposts.city_id')->get();
    }
    public function saveMoviePost(Request $request)
    {
        $post = new Moviepost();
        $post->t_id = $request->t_id;
        $post->m_id = $request->m_id;
        $post->city_id = $request->city_id;

        $post->save();
    }
    public function editMoviePost($id)
    {
        $post = Moviepost::find($id);
        return response()->json($post);
    }

    public function update()
    {
        $post = Moviepost::find(request()->id);
        $post->t_id = request()->t_id;
        $post->m_id = request()->m_id;
        $post->city_id = request()->city_id;
        $post->update();
    }

    public function deleteMoviePost($id)
    {
        $post =Moviepost::find($id)->delete();
    }

    public function getAllMoviePost($id)
    {

        return Moviepost::select('cities.cityname','theatres.name','movies.*','movies.id as m_id')
            ->join('cities', 'movieposts.city_id', '=', 'cities.id')
            ->join('theatres', 'movieposts.t_id', '=', 'theatres.id')
            ->join('movies', 'movieposts.m_id', '=', 'movies.id')
            ->where('movieposts.m_id',$id)
            ->get();

//        return Moviepost::join('theatres','theatres.id','movieposts.t_id')->where('movieposts.m_id',$id)->get();
    }

    public function getMovie()
    {
        $data = Movie::get();

        return response()->json($data);
    }
    public function getTheatrebyid($id)
    {
        return Theatres::where("id",$id)->get();
    }
    public function getTheatre()
    {
        $data = Theatres::get();

        return response()->json($data);
    }
    public function getCity()
    {
        $data = city::get();

        return response()->json($data);
    }
    public function getCitybyid($id)
    {
        return Moviepost::select("cities.*")
            ->join("cities","cities.id","movieposts.city_id")
            ->where("movieposts.t_id",$id)
            ->get();
    }
    public function getMovieHome(){
        return Moviepost::select('movies.title','movieposts.m_id')
            ->join('movies', 'movieposts.m_id', '=', 'movies.id')
            ->join('cities', 'movieposts.city_id', '=', 'cities.id')
            ->join('theatres', 'movieposts.t_id', '=', 'theatres.id')
            ->orderBy('movies.releaseyear')
            ->orderBy('cities.cityname')
            ->distinct()
            ->get();
    }

}
