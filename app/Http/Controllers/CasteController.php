<?php


namespace App\Http\Controllers;

use App\Models\Caste;
use Illuminate\Http\Request;

class CasteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allCast()
    {
        $cast= Caste::all();
        return response()->json($cast);
    }

    public function saveCast(Request $request)
    {
        $cast = new Caste();
        $cast->name = $request->name;
        $cast->bio = $request->bio;

        $cast->save();

    }


    public function editCast($id)
    {
        $cast = Caste::find($id);
        return response()->json($cast);
    }


    public function update()
    {

        $cast = Caste::find(request()->id);
        $cast->name = request()->name;
        $cast->bio = request()->bio;
        $cast->update();
    }


    public function deleteCast($id)
    {
        $cast =Caste::find($id)->delete();
    }
}
