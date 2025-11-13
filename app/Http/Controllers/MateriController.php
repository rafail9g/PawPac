<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::all();
        return view('datamateri', compact('materi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => 'nullable|string|max:255',
            'gambar' => 'nullable|string',
        ]);

        Materi::create($request->all());
        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => 'nullable|string|max:255',
            'gambar' => 'nullable|string',
        ]);

        $materi->update($request->all());
        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        $materi->delete();
        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil dihapus!');
    }
}

