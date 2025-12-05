<?php

namespace App\Http\Controllers;

use App\Models\Kucing;
use App\Models\QuizSoal;
use App\Models\Adoption;
use App\Models\QuizJawaban;
use Illuminate\Http\Request;

class AdoptController extends Controller
{
    public function pilihKucing()
    {
        $kucing = Kucing::where('status', 'available')->get();
        return view('adopterquiz', [
            'kucingList' => $kucing,
            'kucing' => null,
            'soal' => null
        ]);
    }

    public function mulaiQuiz($kucing_id)
    {
        $kucing = Kucing::findOrFail($kucing_id);

        if ($kucing->status === 'adopted') {
            return redirect()->route('adopter.pilih')
                ->with('error', 'Kucing ini sudah diadopsi dan tidak bisa diikuti tes.');
        }

        $existing = Adoption::where('adopter_id', auth()->id())
            ->where('kucing_id', $kucing_id)
            ->whereIn('status', ['pending', 'lulus'])
            ->first();

        if ($existing) {
            return redirect()->route('adopter.status')
                ->with('error', 'Kamu sudah mengajukan adopsi untuk kucing ini.');
        }

        $sessionKey = 'quiz_progress_' . auth()->id() . '_' . $kucing_id;

        if (!session()->has($sessionKey)) {
            session([$sessionKey => [
                'kucing_id' => $kucing_id,
                'jawaban' => [],
                'started_at' => now()
            ]]);
        }

        $progress = session($sessionKey);

        return view('adopterquiz', [
            'kucingList' => null,
            'kucing' => $kucing,
            'soal' => QuizSoal::all(),
            'progress' => $progress
        ]);
    }

    public function saveProgress(Request $request, $kucing_id)
    {
        $sessionKey = 'quiz_progress_' . auth()->id() . '_' . $kucing_id;

        $progress = session($sessionKey, [
            'kucing_id' => $kucing_id,
            'jawaban' => [],
            'started_at' => now()
        ]);

        $progress['jawaban'] = $request->input('jawaban', []);
        session([$sessionKey => $progress]);

        return response()->json(['success' => true, 'message' => 'Progress tersimpan']);
    }

    public function cancelQuiz($kucing_id)
    {
        $sessionKey = 'quiz_progress_' . auth()->id() . '_' . $kucing_id;
        session()->forget($sessionKey);

        return redirect()->route('adopter.pilih')
            ->with('success', 'Quiz dibatalkan. Anda bisa memulai ulang kapan saja.');
    }

    public function submitQuiz(Request $request, $kucing_id)
    {
        $kucing = Kucing::findOrFail($kucing_id);

        if ($kucing->status !== 'available') {
            return redirect()->route('adopter.status')
                ->with('error', 'Kucing ini sudah diadopsi dan tidak bisa diambil tes.');
        }

        $soal = QuizSoal::all();

        foreach ($soal as $s) {
            $inputName = "jawaban_$s->id";

            if ($s->tipe == "isian") {
                $jawaban = $request->input($inputName);

                if (!preg_match('/^[a-zA-Z0-9\s,.\-]+$/u', $jawaban)) {
                    return back()->withErrors([
                        $inputName => 'Jawaban isian hanya boleh mengandung huruf, angka, spasi, koma, titik, dan tanda hubung.'
                    ])->withInput();
                }

                if (empty(trim($jawaban))) {
                    return back()->withErrors([
                        $inputName => 'Jawaban tidak boleh kosong.'
                    ])->withInput();
                }
            }
        }

        $totalNilai = 0;

        $adopsi = Adoption::create([
            'adopter_id' => auth()->id(),
            'kucing_id' => $kucing_id,
            'nilai_quiz' => null,
            'status' => 'pending'
        ]);

        foreach ($soal as $s) {
            $inputName = "jawaban_$s->id";
            $jawabanUser = $request->input($inputName);

            QuizJawaban::create([
                'adopsi_id' => $adopsi->id,
                'soal_id' => $s->id,
                'jawaban' => $jawabanUser,
                'is_correct' => $s->tipe == 'pg'
                    ? ($jawabanUser == $s->jawaban_benar)
                    : null
            ]);

            if ($s->tipe == "pg" && $jawabanUser == $s->jawaban_benar) {
                $totalNilai++;
            }
        }

        $adopsi->update(['nilai_quiz' => $totalNilai]);

        $sessionKey = 'quiz_progress_' . auth()->id() . '_' . $kucing_id;
        session()->forget($sessionKey);

        return redirect()->route('adopter.status')
            ->with('success', 'Tes selesai! Jawaban isian sedang menunggu verifikasi provider.');
    }

    public function status()
    {
        $riwayat = Adoption::where('adopter_id', auth()->id())->latest()->get();
        return view('adopterstatus', compact('riwayat'));
    }
}
