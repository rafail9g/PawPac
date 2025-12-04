<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\InfoLokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdopterController extends Controller
{
    public function index()
    {
        $adopters = Pengguna::where('role', 'adopter')->get();
        return view('dataadopter', compact('adopters'));
    }

    public function create()
    {
        return view('adopter_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|min:6',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'living_environment' => 'nullable|string',
        ]);

        Pengguna::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'adopter',
            'address' => $request->address,
            'phone' => $request->phone,
            'living_environment' => $request->living_environment,
        ]);

        return redirect()->route('admin.adopter.index')->with('success', 'Adopter berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $adopter = Pengguna::findOrFail($id);
        return view('adopter_edit', compact('adopter'));
    }

    public function update(Request $request, $id)
    {
        $adopter = Pengguna::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:pengguna,email,' . $id,
        ]);

        $adopter->update([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'living_environment' => $request->living_environment,
        ]);

        return redirect()->route('admin.adopter.index')->with('success', 'Data adopter berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $adopter = Pengguna::findOrFail($id);
        $adopter->delete();

        return redirect()->route('admin.adopter.index')->with('success', 'Adopter berhasil dihapus!');
    }

    public function getJson($id)
    {
        $adopter = Pengguna::find($id);

        if (!$adopter) {
            return response()->json(['error' => 'Adopter tidak ditemukan'], 404);
        }

        return response()->json($adopter);
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email,' . $user->id,
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'living_environment' => 'nullable|string',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
        ]);

        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->living_environment = $request->living_environment;

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return redirect()->route('adopter.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function map()
{
    $lokasi = \App\Models\Lokasi::first();
    $info = InfoLokasi::first();

    return view('adopterloc', [
        'lat' => $lokasi->lat,
        'lng' => $lokasi->lng,
        'info' => $info,
    ]);
}

}
