<?php

namespace App\Http\Controllers;

use App\Models\city;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function allCity()
    {
        $city= city::all();
        return response()->json($city);
    }

    public function saveCity(Request $request)
    {
        $city = new city();
        $city->cityname = $request->cityname;

        $city->save();

    }


    public function editCity($id)
    {
        $city = city::find($id);
        return response()->json($city);
    }

    public function updateCity()
    {
        $city = city::find(request()->id);
        $city->cityname = request()->cityname;
        $city->update();
    }


    public function deleteCity($id)
    {
        $city =city::find($id)->delete();
    }
}
