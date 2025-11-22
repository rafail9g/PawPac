<?php

namespace App\Http\Controllers;

use App\Models\Kucing;
use App\Models\QuizSoal;
use App\Models\Adoption;
use App\Models\QuizJawaban;
use Illuminate\Http\Request;

class ProviderAdoptController extends Controller
{
    public function index()
    {
        $pengajuan = Adoption::with('adopter','kucing')->latest()->get();
        return view('nilai', compact('pengajuan'));
    }


    public function review($id)
    {
        $adopsi = Adoption::with(['kucing','adopter','jawaban.soal'])->findOrFail($id);

        return view('nilai', compact('adopsi'));
    }


    public function nilai(Request $request, $id)
    {
        $adopsi = Adoption::findOrFail($id);

        $total = 0;

        foreach ($adopsi->jawaban as $j) {

            // kalau PG sudah otomatis dinilai
            if ($j->soal->tipe == "pg") {
                if ($j->is_correct) $total++;
                continue;
            }

            // kalau isian → provider nilai manual
            $j->is_correct = $request->input("nilai_$j->id");
            $j->save();

            if ($j->is_correct) $total++;
        }

        $adopsi->status = $request->status;
        $adopsi->save();

        // --- Jika diterima, ubah status kucing jadi unavailable ---
        if ($request->status === 'lulus') {
            $kucing = Kucing::find($adopsi->kucing_id);
            if ($kucing) {
                $kucing->status = 'unavailable';
                $kucing->save();
            }
        }


        return redirect('/provider/adoption')
            ->with('success', 'Penilaian berhasil disimpan.');

    }

}
