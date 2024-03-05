<?php

namespace App\Http\Controllers;

use App\Models\Malfunction;
use App\Models\MalfunctionHandling;
use App\Models\Status;
use Illuminate\Http\Request;

class MalfunctionHandlingController extends Controller
{
    public function create(Malfunction $malfunction)
    {
        $malfunctionHandling = MalfunctionHandling::whereHas('Malfunctions', function ($query) use ($malfunction) {
            $query->where('id', $malfunction->id);
        })->first();
        return view('storing.StoringAfhandelen', compact('malfunction', 'malfunctionHandling'));
    }

    public function store(Request $request, Malfunction $malfunction)
    {
        $kostenInput = $request->Kosten;
        $kosten = str_replace(',', '.', $kostenInput);

        request()->validate([
            'activities'       => ['required'],
            'description' => ['required'],
            'mileage'       => ['required', 'numeric'],
            'material' => ['required'],
            'Hoeveelheid' => ['required', 'numeric'],
            'Kosten' => ['required']
        ]);

        $malfunctionHandling = MalfunctionHandling::whereHas('Malfunctions', function ($query) use ($malfunction) {
            $query->where('id', $malfunction->id);
        })->first();

        $malfunctionHandling->activities       = $request->activities;
        $malfunctionHandling->description = $request->description;
        $malfunctionHandling->material = $request->material;
        $malfunctionHandling->mileage = $request->mileage;
        $malfunctionHandling->cost = $request->Hoeveelheid * $kosten;
        $malfunctionHandling->save();

        $malfunction->status_id = Status::CLOSED;
        $malfunction->save();

        return redirect()->route('dashboard');
    }

    public function update(Request $request, MalfunctionHandling $malfunctionHandling)
    {
        $kostenInput = $request->Kosten;
        $kosten = str_replace(',', '.', $kostenInput);

        request()->validate([
            'activities'       => ['required'],
            'description' => ['required'],
            'mileage'       => ['required', 'numeric'],
            'material' => ['required'],
            'Hoeveelheid' => ['required', 'numeric'],
            'Kosten' => ['required']
        ]);

        $malfunctionHandling->activities       = $request->activities;
        $malfunctionHandling->description = $request->description;
        $malfunctionHandling->material = $request->material;
        $malfunctionHandling->mileage = $request->mileage;
        $malfunctionHandling->cost = $request->Hoeveelheid * $kosten;
        $malfunctionHandling->save();

        $malfunctions = Malfunction::whereHas('MalfunctionsHandling', function ($query) use ($malfunctionHandling) {
            $query->where('id', $malfunctionHandling->id);
        })->get();

        foreach ($malfunctions as $malfunction) {
            $malfunction->status_id = Status::CLOSED;
            $malfunction->save();
        }

        return redirect()->route('dashboard');
    }
}
