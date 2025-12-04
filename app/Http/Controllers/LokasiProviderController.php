<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lokasi;

class LokasiProviderController extends Controller
{
    public function editLocation()
{
    $shelter = Lokasi::first();
    return view('provider.location', compact('shelter'));
}

public function updateLocation(Request $request)
{
    $request->validate([
        'lat' => 'required',
        'lng' => 'required',
    ]);

    $shelter = Lokasi::first();
    $shelter->lat = $request->lat;
    $shelter->lng = $request->lng;
    $shelter->save();

    return back()->with('success', 'Lokasi shelter berhasil diperbarui!');
}

}
