<?php

namespace App\Http\Controllers;

use App\Models\QuizSoal;
use Illuminate\Http\Request;

class QuizAdminController extends Controller
{
    public function index()
    {
        $soal = QuizSoal::all();
        return view('quizadmin', compact('soal'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'tipe' => 'required|in:pg,isian',
            'opsi_a' => 'required_if:tipe,pg|nullable|string',
            'opsi_b' => 'required_if:tipe,pg|nullable|string',
            'opsi_c' => 'required_if:tipe,pg|nullable|string',
            'opsi_d' => 'required_if:tipe,pg|nullable|string',
            'jawaban_benar' => 'required_if:tipe,pg|nullable|string|in:A,B,C,D',
        ], [
            'pertanyaan.required' => 'Pertanyaan wajib diisi',
            'tipe.required' => 'Tipe soal wajib dipilih',
            'opsi_a.required_if' => 'Opsi A wajib diisi untuk soal pilihan ganda',
            'jawaban_benar.in' => 'Jawaban benar harus salah satu dari A, B, C, atau D',
        ]);

        QuizSoal::create([
            'pertanyaan' => $validated['pertanyaan'],
            'tipe' => $validated['tipe'],
            'opsi_a' => $validated['tipe'] == 'pg' ? $validated['opsi_a'] : null,
            'opsi_b' => $validated['tipe'] == 'pg' ? $validated['opsi_b'] : null,
            'opsi_c' => $validated['tipe'] == 'pg' ? $validated['opsi_c'] : null,
            'opsi_d' => $validated['tipe'] == 'pg' ? $validated['opsi_d'] : null,
            'jawaban_benar' => $validated['tipe'] == 'pg' ? $validated['jawaban_benar'] : null,
            'tipe_soal' => $validated['tipe'] == 'pg' ? 'pilihan' : 'isian',
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

        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'tipe' => 'required|in:pg,isian',
            'opsi_a' => 'required_if:tipe,pg|nullable|string',
            'opsi_b' => 'required_if:tipe,pg|nullable|string',
            'opsi_c' => 'required_if:tipe,pg|nullable|string',
            'opsi_d' => 'required_if:tipe,pg|nullable|string',
            'jawaban_benar' => 'required_if:tipe,pg|nullable|string|in:A,B,C,D',
        ]);

        $soal->update([
            'pertanyaan' => $validated['pertanyaan'],
            'tipe' => $validated['tipe'],
            'opsi_a' => $validated['tipe'] == 'pg' ? $validated['opsi_a'] : null,
            'opsi_b' => $validated['tipe'] == 'pg' ? $validated['opsi_b'] : null,
            'opsi_c' => $validated['tipe'] == 'pg' ? $validated['opsi_c'] : null,
            'opsi_d' => $validated['tipe'] == 'pg' ? $validated['opsi_d'] : null,
            'jawaban_benar' => $validated['tipe'] == 'pg' ? $validated['jawaban_benar'] : null,
            'tipe_soal' => $validated['tipe'] == 'pg' ? 'pilihan' : 'isian',
        ]);

        return redirect()->route('admin.quiz.index')->with('success', 'Soal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $soal = QuizSoal::findOrFail($id);

        $soal->jawaban()->delete();

        $soal->delete();

        return redirect()->route('admin.quiz.index')->with('success', 'Soal berhasil dihapus!');
    }
}
