<?php

namespace App\Http\Controllers;

use App\Models\showtime;
use Illuminate\Http\Request;

class ShowTimeController extends Controller
{
    public function allshow()
    {
        $show= showtime::all();
        return response()->json($show);
    }

    public function save(Request $request)
    {
        $show = new showtime();
        $show->showtime = $request->showtime;
        $show->save();

    }
    public function edit($id)
    {
        $show = showtime::find($id);
        return response()->json($show);
    }

    public function update()
    {
        $show= showtime::find(request()->id);
        $show->showtime = request()->showtime;
        $show->update();
    }

    public function delete($id)
    {
        $show =showtime::find($id)->delete();
    }
    public function getshowtime()
    {
        $data = showtime::get();

        return response()->json($data);
    }

}
