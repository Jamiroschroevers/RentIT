<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Status;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    public function create($property)
    {
        return view('tenant.create', compact('property'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'firstname'   => 'required',
            'lastname'    => 'required',
            'birthday'    => 'required',
            'email'       => 'required|email|unique:tenants,email',
            'phonenumber' => 'required',
        ]);

        $imageData = $request->input('image');
        $tenant    = new Tenant();
        if ($imageData !== null) {
            $randomNumber = mt_rand();
            $imageName    = 'canvas_' . $randomNumber . '.png'; // Gegenereerde bestandsnaam
            $imagePath    = storage_path('app/public/' . $imageName);
            file_put_contents($imagePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)));
            $tenant->signature   = $imageName;
            $tenant->firstname   = $request->firstname;
            $tenant->lastname    = $request->lastname;
            $tenant->birthday    = $request->birthday;
            $tenant->email       = $request->email;
            $tenant->phonenumber = $request->phonenumber;
            $tenant->date        = now();
            $tenant->save();

            $property            = Property::findOrFail($id);
            $property->tenant_id = $tenant->id;
            $property->status_id = Status::RESERVED;
            $property->save();
        }

        return redirect()->route('property.index')
                         ->with('message', 'Succesvol aangemaakt!');
    }

    public function show($id)
    {
        $property = Property::findOrFail($id);
        $tenant   = Tenant::findOrFail($property->tenant_id);

        return view('tenant.show', [
            'tenant'   => $tenant,
            'property' => $property,
        ]);
    }
}
