<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Malfunction;
use App\Models\MalfunctionHandling;
use App\Models\Workorder;
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
            'activities'  => ['required'],
            'description' => ['required'],
            'mileage'     => ['required'],
            'material'    => ['required'],
            'Hoeveelheid' => ['required'],
            'Kosten'      => ['required'],
        ]);

        $storing              = new MalfunctionHandling();
        $storing->activities  = $request->activities;
        $storing->description = $request->description;
        $storing->material    = $request->material;
        $storing->mileage     = $request->mileage;
        $storing->cost        = $request->Hoeveelheid * $request->Kosten;
        $images               = request()->image;

        if (isset($images)) {
            $storing->save();
        }
        foreach ($images as $image) {
            $imageNewFileName = time() . random_int(1, 99) . '.' . $image->extension();
            $image->storeAs('public', $imageNewFileName);

            $image        = new Image();
            $image->name  = $imageNewFileName;
            $image->url   = 'storage/';
            $image->MH_id = $storing->id;
            $image->save();
        }

        return redirect()->route('dashboard');
    }
}
