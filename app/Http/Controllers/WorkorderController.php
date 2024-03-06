<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Workorder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkorderController extends Controller
{
    public function index()
    {
        $user      = Auth::user()->id;
        $workorder = Workorder::where('user_id', $user)
                              ->whereNull('signature')
                              ->first();

        return view('workorder.index', [
            'workorder' => $workorder,
        ]);
    }

    public function store(Request $request, $workorder)
    {
        $imageData = $request->input('image');
        $workorder = Workorder::findOrFail($workorder);
        if ($imageData !== null) {
            $randomNumber = mt_rand();
            $imageName    = 'canvas_' . $randomNumber . '.png'; // Gegenereerde bestandsnaam
            $imagePath    = storage_path('app/public/' . $imageName);
            file_put_contents($imagePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)));
            $workorder->signature        = $imageName;
            $workorder->timeregistration = $request->timeregistration;
            $workorder->price            = $request->price;
            $workorder->comments         = $request->comments;
            $workorder->save();
        }

        $data = Workorder::findOrFail($workorder->id);

        $pdf = PDF::loadView('pdf.show', compact('data'));

        $pdf->download('werkbon.pdf');

        return redirect()->route('workorder.index');
    }

    public function show($id)
    {
        $data = Workorder::findOrFail($id);

        return view('pdf.show', [
            'data' => $data,
        ]);
    }
}
