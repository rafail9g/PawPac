<?php

namespace App\Http\Controllers;

use App\Models\Adopter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdopterController extends Controller
{
    public function index()
    {
    $adopters = \App\Models\Pengguna::where('role', 'adopter')->get();
        return view('dataadopter', compact('adopters')); // ubah di sini
    }

    public function create()
    {
        return view('adopter_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:pengguna',
            'password' => 'required|min:6',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'living_environment' => 'nullable|string',
        ]);

        Adopter::create([
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
        $adopter = Adopter::findOrFail($id);
        return view('adopter_edit', compact('adopters'));
    }

    public function update(Request $request, $id)
    {
        $adopter = Adopter::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:pengguna,email,' . $id,
        ]);

        $adopter->update($request->all());

        return redirect()->route('admin.adopter.index')->with('success', 'Data adopter berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $adopter = Adopter::findOrFail($id);
        $adopter->delete();

        return redirect()->route('admin.adopter.index')->with('success', 'Adopter berhasil dihapus!');
    }
}
