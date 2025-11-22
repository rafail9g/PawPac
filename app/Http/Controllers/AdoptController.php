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

        // ❗ CEK apakah kucing sudah diadopsi
        if ($kucing->status === 'adopted') {
            return redirect()->route('adopter.pilih')
                ->with('error', 'Kucing ini sudah diadopsi dan tidak bisa diikuti tes.');
        }

        // ❗ CEK apakah user sudah ikut tes untuk kucing ini
        $existing = Adoption::where('adopter_id', auth()->id())
            ->where('kucing_id', $kucing_id)
            ->whereIn('status', ['pending', 'lulus'])
            ->first();

        if ($existing) {
            return redirect()->route('adopter.status')
                ->with('error', 'Kamu sudah mengajukan adopsi untuk kucing ini.');
        }

        return view('adopterquiz', [
            'kucingList' => null,
            'kucing' => $kucing,
            'soal' => QuizSoal::all()
        ]);
    }



    public function submitQuiz(Request $request, $kucing_id)
    {
        // Cek apakah kucing masih available
        $kucing = Kucing::findOrFail($kucing_id);

        if ($kucing->status !== 'available') {
            return redirect()->route('adopter.status')
                ->with('error', 'Kucing ini sudah diadopsi dan tidak bisa diambil tes.');
        }

        $soal = QuizSoal::all();
        $totalNilai = 0;

        // Buat data adopsi dulu
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

        return redirect()->route('adopter.status')
            ->with('success', 'Tes selesai! Jawaban isian sedang menunggu verifikasi provider.');
    }


    public function status()
    {
        $riwayat = Adoption::where('adopter_id', auth()->id())->latest()->get();
        return view('adopterstatus', compact('riwayat'));
    }
}
