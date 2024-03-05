<?php

namespace App\Http\Controllers;

use App\Models\Malfunction;
use App\Models\MalfunctionHandling;
use App\Models\Property;
use App\Models\Status;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Workorder;
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
        $users        = User::where('role_id', '3')->get();

        return view('storing.StoringOverzicht', compact('malfunctions', 'users'));
    }

    public function storeAdmin(Request $request, Malfunction $malfunction)
    {
        request()->validate([
            'monteur' => ['required'],
        ]);

        $storingHandeling                 = new MalfunctionHandling();
        $storingHandeling->malfunction_id = $malfunction->id;
        $storingHandeling->user_id        = $request->monteur;
        $storingHandeling->save();

        // Status Updaten
        $malfunction->status_id = Status::PLANNED;
        $malfunction->save();

        //workorder
        $workorder            = new Workorder();
        $workorder->user_id   = $storingHandeling->user_id;
        $workorder->MH_id     = $storingHandeling->id;
        $workorder->tenant_id = $malfunction->tenant_id;
        $workorder->save();

        return redirect()->route('Astoring.index');
    }

    public function updateAdmin(Malfunction $malfunction)
    {
        // Status Updaten
        $malfunction->status_id = Status::PLANNED;
        $malfunction->save();

        return redirect()->route('Astoring.index');
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
