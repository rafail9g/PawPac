<?php

namespace App\Http\Controllers;

use App\Models\QuizSoal;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $soal = QuizSoal::all();
        return view('quiz', compact('soal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'jawaban_benar' => 'required'
        ]);

        QuizSoal::create($request->all());

        return back()->with('success', 'Soal berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $soal = QuizSoal::findOrFail($id);

        $soal->update($request->all());

        return back()->with('success', 'Soal berhasil diupdate');
    }

    public function destroy($id)
    {
        QuizSoal::findOrFail($id)->delete();

        return back()->with('success', 'Soal berhasil dihapus');
    }
}
