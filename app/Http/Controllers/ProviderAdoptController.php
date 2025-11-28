<?php

namespace App\Http\Controllers;

use App\Models\Kucing;
use App\Models\QuizSoal;
use App\Models\Adoption;
use App\Models\QuizJawaban;
use App\Models\HistoryAdopt;
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

            if ($j->soal->tipe == "pg") {
                if ($j->is_correct) $total++;
                continue;
            }

            $j->is_correct = $request->input("nilai_$j->id");
            $j->save();

            if ($j->is_correct) $total++;
        }

        $adopsi->status = $request->status;
        $adopsi->nilai_quiz = $total;
        $adopsi->save();

        HistoryAdopt::create([
            'adopsi_id' => $adopsi->id,
            'catatan' => 'Penilaian oleh provider pada ' . now()->format('d M Y H:i'),
            'status' => $request->status
        ]);

        if ($request->status === 'lulus') {
            $kucing = Kucing::find($adopsi->kucing_id);
            if ($kucing) {
                $kucing->status = 'adopted';
                $kucing->save();
            }

            Adoption::where('kucing_id', $adopsi->kucing_id)
                ->where('id', '!=', $adopsi->id)
                ->where('status', 'pending')
                ->update(['status' => 'tidak_lulus']);
        }

        return redirect('/provider/adoption')
            ->with('success', 'Penilaian berhasil disimpan dan history tercatat.');
    }
}
