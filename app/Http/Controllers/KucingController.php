<?php

namespace App\Http\Controllers;

use App\Models\Kucing;
use Illuminate\Http\Request;

class KucingController extends Controller
{
    public function index()
    {
        $kucing = Kucing::all();
        return view('datakucing', compact('kucing'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'breed' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:available,adopted',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/kucing', 'public');
        } else {
            $imagePath = null;
        }

        Kucing::create([
            'provider_id' => 1,
            'name' => $request->name,
            'age' => $request->age,
            'breed' => $request->breed,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status ?? 'available',
        ]);

        return redirect()->route('provider.kucing.index')->with('success', 'Data kucing berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $kucing = Kucing::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'breed' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:available,adopted',
            'image' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/kucing', 'public');
            $kucing->image = $imagePath;
        }

        $kucing->update($request->all());
        return redirect()->route('provider.kucing.index')->with('success', 'Data kucing berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kucing = Kucing::findOrFail($id);
        $kucing->delete();

        return redirect()->route('provider.kucing.index')->with('success', 'Data kucing berhasil dihapus!');
    }
}
