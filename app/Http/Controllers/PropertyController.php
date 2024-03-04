<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Role;
use App\Models\Status;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    public function index()
    {
        $admin = Role::ADMIN;

        $properties = Property::all();

        $statuses = DB::table('statuses')->whereIn('id', [1, 2, 3])->get();

        return view('property.index', [
            'properties' => $properties,
            'statuses'   => $statuses,
            'admin'      => $admin,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::whereIn('id', [1, 2, 3])->get();

        return view('property.create', [
            'statuses' => $statuses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'street' => 'required',
            'house_number' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'status_id' => 'nullable',
            'tenant_id' => 'nullable',
        ]);

        $data       = $this->getAddress($request->postal_code);
        $jsonString = $data->getContent();
        $dataArray  = json_decode($jsonString, true);

        $city   = $dataArray['city'];
        $street = $dataArray['street'];

        $property = new Property();
        $property->street = $street;
        $property->house_number = $request->house_number;
        $property->postal_code = $request->postal_code;
        $property->city = $city;
        $property->status_id = Status::FOR_RENT;
        $property->save();

        return redirect()->route('property.index')
                         ->with('message', 'Succesvol aangemaakt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    { 
        $admin = Role::ADMIN;
        $property = Property::findOrFail($id);
        $statuses = DB::table('statuses')->whereIn('id', [1, 2, 3])->get();
        $defaultStatus = $statuses->first(); // Haal de eerste status op

        return view('property.show', [
            'property' => $property,
            'statuses' => $statuses,
            'defaultStatus' => $defaultStatus,
          'admin'    => $admin,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
    {
        return view('property.edit', [
            'property' => $property,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Property $property, Request $request)
    {
        $request->validate([
            'street' => 'required',
            'house_number' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'status_id' => 'nullable',
            'tenant_id' => 'nullable',
        ]);

        $data       = $this->getAddress($request->postal_code);
        $jsonString = $data->getContent();
        $dataArray  = json_decode($jsonString, true);

        $city   = $dataArray['city'];
        $street = $dataArray['street'];

        if (Property::where('id', $property)->exists()) {
            $property->street       = $street;
            $property->house_number = $request->house_number;
            $property->postal_code = $request->postal_code;
            $property->city = $city;
            $property->save();
        }

        return redirect()->route('property.show', $id)
                         ->with('message', 'Succesvol bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return redirect()->route('property.index')
                         ->with('message', 'Succesvol verwijderd!');
    }

    public function getAddress($postcode): JsonResponse
    {
        $postcode = str_replace(' ', '', $postcode);
        $client = new Client();
        $url = 'https://api.pdok.nl/bzk/locatieserver/search/v3_1/free';

        try {
            $response = $client->request('GET', $url, [
                'query' => [
                    'fq' => 'postcode:' . $postcode,
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                $body = $response->getBody();

                $data = json_decode($body, true);

                $city = $data['response']['docs'][0]['woonplaatsnaam'];
                $street = $data['response']['docs'][0]['straatnaam'];

                return response()->json(['city' => $city, 'street' => $street]);
            } else {
                return response()->json(['error' => 'API request failed'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function save_property(Request $request, Property $property)
    {
        $atributer = $request->fieldName;
        $field = $request->field;
        try {
            if ($atributer === 'status_filter') {
                $property->status_id = $field;
            } else {
                $property->$atributer = $field;
            }
            $property->save();

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            Log::error('Fout bij het opslaan van de ' . $atributer . ': ' . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'Er is een fout opgetreden bij het opslaan van het ' . $atributer]);
        }
    }
}
