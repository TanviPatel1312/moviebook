<?php

namespace App\Http\Controllers;


use App\Models\Movie;
use App\Models\Theatres;
use Illuminate\Http\Request;

class TheatresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allTheatre()
    {
        $theatre= Theatres::all();
        return response()->json($theatre);
    }

    public function saveTheatre()
    {
        $theatre = new Theatres();
        $theatre->name = request()->name;
        $theatre->starttime = request()->starttime;
        $theatre->endtime = request()->endtime;
        $theatre->price = request()->price;
        $theatre->seatsAvailable = request()->seatsAvailable;
        $theatre->totalseat = request()->totalseat;
        $theatre->save();
    }

    public function editTheatre($id)
    {
        $theatre = Theatres::find($id);
        return response()->json($theatre);
    }


    public function update()
    {
        $theatre = Theatres::find(request()->id);
        $theatre->name = request()->name;
        $theatre->starttime = request()->starttime;
        $theatre->endtime = request()->endtime;
        $theatre->price = request()->price;
        $theatre->seatsAvailable = request()->seatsAvailable;
        $theatre->totalseat = request()->totalseat;
        $theatre->update();
    }
    public function deleteTheatre($id)
    {
        $theatre =Theatres::find($id)->delete();
    }

}
