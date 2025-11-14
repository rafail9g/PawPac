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
            'isi'   => 'required|string', // validasi tambahan di bawah
            'kategori' => 'nullable|string|max:255',
        ]);

        // Batas 1000 kata
        if (str_word_count($request->isi) > 1000) {
            return back()->withErrors(['isi' => 'Isi materi tidak boleh lebih dari 1000 kata!'])->withInput();
        }

        Materi::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.materi.index')
            ->with('success', 'Materi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'isi'   => 'required|string',
            'kategori' => 'nullable|string|max:255',
        ]);

        // Batas 1000 kata
        if (str_word_count($request->isi) > 1000) {
            return back()->withErrors(['isi' => 'Isi materi tidak boleh lebih dari 1000 kata!'])->withInput();
        }

        $materi->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.materi.index')
            ->with('success', 'Materi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $materi = Materi::findOrFail($id);
        $materi->delete();

        return redirect()->route('admin.materi.index')
            ->with('success', 'Materi berhasil dihapus!');
    }

    public function getJson($id)
    {
        $materi = Materi::find($id);

        if (!$materi) {
            return response()->json(['error' => 'Materi tidak ditemukan'], 404);
        }

        return response()->json($materi);
    }
}
