<?php

namespace App\Http\Controllers;

use App\Models\QuizSoal;
use Illuminate\Http\Request;

class QuizAdminController extends Controller
{
    public function index()
    {
        $soal = QuizSoal::all();
        return view('admin.quiz', compact('soal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required|string',
            'tipe' => 'required|in:pg,isian',
            'opsi_a' => 'required_if:tipe,pg',
            'opsi_b' => 'required_if:tipe,pg',
            'opsi_c' => 'required_if:tipe,pg',
            'opsi_d' => 'required_if:tipe,pg',
            'jawaban_benar' => 'required_if:tipe,pg',
        ]);

        QuizSoal::create([
            'pertanyaan' => $request->pertanyaan,
            'tipe' => $request->tipe,
            'opsi_a' => $request->tipe == 'pg' ? $request->opsi_a : null,
            'opsi_b' => $request->tipe == 'pg' ? $request->opsi_b : null,
            'opsi_c' => $request->tipe == 'pg' ? $request->opsi_c : null,
            'opsi_d' => $request->tipe == 'pg' ? $request->opsi_d : null,
            'jawaban_benar' => $request->tipe == 'pg' ? $request->jawaban_benar : null,
            'tipe_soal' => $request->tipe == 'pg' ? 'pilihan' : 'isian',
        ]);

        return redirect()->route('admin.quiz.index')->with('success', 'Soal berhasil ditambahkan!');
    }

    public function getJson($id)
    {
        $soal = QuizSoal::find($id);

        if (!$soal) {
            return response()->json(['error' => 'Soal tidak ditemukan'], 404);
        }

        return response()->json($soal);
    }

    public function update(Request $request, $id)
    {
        $soal = QuizSoal::findOrFail($id);

        $request->validate([
            'pertanyaan' => 'required|string',
            'tipe' => 'required|in:pg,isian',
            'opsi_a' => 'required_if:tipe,pg',
            'opsi_b' => 'required_if:tipe,pg',
            'opsi_c' => 'required_if:tipe,pg',
            'opsi_d' => 'required_if:tipe,pg',
            'jawaban_benar' => 'required_if:tipe,pg',
        ]);

        $soal->update([
            'pertanyaan' => $request->pertanyaan,
            'tipe' => $request->tipe,
            'opsi_a' => $request->tipe == 'pg' ? $request->opsi_a : null,
            'opsi_b' => $request->tipe == 'pg' ? $request->opsi_b : null,
            'opsi_c' => $request->tipe == 'pg' ? $request->opsi_c : null,
            'opsi_d' => $request->tipe == 'pg' ? $request->opsi_d : null,
            'jawaban_benar' => $request->tipe == 'pg' ? $request->jawaban_benar : null,
            'tipe_soal' => $request->tipe == 'pg' ? 'pilihan' : 'isian',
        ]);

        return redirect()->route('admin.quiz.index')->with('success', 'Soal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $soal = QuizSoal::findOrFail($id);
        $soal->delete();

        return redirect()->route('admin.quiz.index')->with('success', 'Soal berhasil dihapus!');
    }
}
