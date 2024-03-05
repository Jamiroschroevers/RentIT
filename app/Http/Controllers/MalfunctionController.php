<?php

namespace App\Http\Controllers;

use App\Models\Malfunction;
use App\Models\Property;
use App\Models\Status;
use App\Models\Tenant;
use App\Rules\ExistingTenant;
use Illuminate\Http\Request;

class MalfunctionController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        $statuss    = Status::whereIn('id', [4, 5, 6])->get();

        return view('storing.Storing', compact('properties', 'statuss'));
    }

    public function indexAdmin()
    {
        $malfunctions = Malfunction::query()->orderBy('emergency', 'desc')->get();

        return view('storing.StoringOverzicht', compact('malfunctions'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'space'       => ['required'],
            'description' => ['required'],
            'email'       => ['required', 'email', new ExistingTenant()],
        ]);

        $tenantId = Tenant::where('email', $request->email)->pluck('id')->first();
        $storing  = new Malfunction();
        if (request('emergency') != null) {
            $storing->emergency = true;
        } else {
            $storing->emergency = false;
        }
        $storing->space       = $request->space;
        $storing->description = $request->description;
        $storing->status_id   = Status::OPEN;
        $storing->tenant_id   = $tenantId;
        $storing->save();

        return redirect()->route('dashboard');
    }
}
