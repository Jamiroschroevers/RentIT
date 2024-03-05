<?php

namespace App\Http\Controllers;

use App\Models\Malfunction;
use App\Models\MalfunctionHandling;
use Illuminate\Http\Request;

class MalfunctionHandlingController extends Controller
{
    public function create(Malfunction $malfunction)
    {
        return view('storing.StoringAfhandelen', compact('malfunction'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'activities'       => ['required'],
            'description' => ['required'],
            'mileage'       => ['required'],
            'material' => ['required'],
            'Hoeveelheid' => ['required'],
            'Kosten' => ['required']
        ]);

        $storing  = new MalfunctionHandling();
        $storing->activities       = $request->activities;
        $storing->description = $request->description;
        $storing->material = $request->material;
        $storing->mileage = $request->mileage;
        $storing->cost = $request->Hoeveelheid * $request->Kosten;
        $storing->save();

        return redirect()->route('dashboard');
    }
}
