<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Status;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class PropertyController extends Controller
{
    public function index()
    {
        $property = Property::query();

        // Ophalen van de opgeslagen status uit de sessie
        $status = session('status');

        if (request()->has('query')) {
            $query = request('query');

            $property->where(function ($queryBuilder) use ($query, $status) {
                if (!empty($status)) {
                    $queryBuilder->where('status_id', 'LIKE', $status);
                } else {
                    $queryBuilder
                        ->where('street', 'LIKE', "%$query%")
                        ->orWhere('house_number', 'LIKE', "%$query%")
                        ->orWhere('postal_code', 'LIKE', "%$query%")
                        ->orWhere('city', 'LIKE', "%$query%")
                        ->orWhere('tenant_id', 'LIKE', "%$query%");
                }
            });
        }

        if (request()->has('status_filter')) {
            $statusFilter = request('status_filter');

            $property->where('status_id', 'like', "%$statusFilter%");

            // Opslaan van de status in de sessie
            session(['status' => $statusFilter]);
        }

        $properties = $property->get();

        $statuses = DB::table('statuses')->whereIn('id', [1, 2, 3])->get();

        return view('property.index', [
            'properties' => $properties,
            'statuses' => $statuses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::whereIn('id', [1, 2, 3])->get();

        return view('property.create', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'street'       => 'required',
            'house_number' => 'required',
            'postal_code'  => 'required',
            'city'         => 'required',
            'status_id'    => 'nullable',
            'tenant_id'    => 'nullable',
        ]);

        $data = $this->getAddress($request, $request->postal_code);
        $jsonString = $data->getContent();
        $dataArray = json_decode($jsonString, true);

        $city = $dataArray['city'];
        $street = $dataArray['street'];

        $property               = new Property();
        $property->street       = $street;
        $property->house_number = $request->house_number;
        $property->postal_code  = $request->postal_code;
        $property->city         = $city;
        $property->status_id    = Status::FOR_RENT;
        $property->save();

        return redirect()->route('property.index')
            ->with('message', 'Succesvol aangemaakt!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $property = Property::findOrFail($id);

        return view('property.show', [
            'property' => $property,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $property = Property::findOrFail($id);

        return view('property.edit', [
            'property' => $property,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'street'       => 'required',
            'house_number' => 'required',
            'postal_code'  => 'required',
            'city'         => 'required',
            'status_id'    => 'nullable',
            'tenant_id'    => 'nullable',
        ]);

        $data = $this->getAddress($request, $request->postal_code);
        $jsonString = $data->getContent();
        $dataArray = json_decode($jsonString, true);

        $city = $dataArray['city'];
        $street = $dataArray['street'];

        if (Property::where('id', $id)->exists()) {
            $property               = Property::findOrFail($id);
            $property->street       = $street;
            $property->house_number = $request->house_number;
            $property->postal_code  = $request->postal_code;
            $property->city         = $city;
            $property->save();
        }

        return redirect()->route('property.show', $id)
            ->with('message', 'Succesvol bijgewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        $property->delete();

        return redirect()->route('property.index')
            ->with('message', 'Succesvol verwijderd!');
    }

    public function getAddress(Request $request, $postcode): \Illuminate\Http\JsonResponse
    {
        $postcode = str_replace(' ', '', $postcode);
        $client   = new Client();
        $url      = 'https://api.pdok.nl/bzk/locatieserver/search/v3_1/free';

        try {
            $response = $client->request('GET', $url, [
                'query' => [
                    'fq' => 'postcode:' . $postcode,
                ],
            ]);

            if ($response->getStatusCode() == 200) {
                $body = $response->getBody();

                $data = json_decode($body, true);

                $city   = $data['response']['docs'][0]['woonplaatsnaam'];
                $street = $data['response']['docs'][0]['straatnaam'];

                return response()->json(['city' => $city, 'street' => $street]);
            } else {
                return response()->json(['error' => 'API request failed'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
