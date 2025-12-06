<?php

namespace App\Http\Controllers;

use App\Models\Kucing;
use App\Models\QuizSoal;
use App\Models\Adoption;
use App\Models\QuizJawaban;
use App\Models\HistoryAdopt;
use App\Models\Lokasi;
use App\Models\InfoLokasi;
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

            if ($j->soal->tipe_soal == "pg") {
                if ($j->is_correct) $total++;
                continue;
            }

            if ($j->soal->tipe_soal == "isian") {
                $nilaiInput = $request->input("nilai_$j->id");

                if ($nilaiInput === null) {
                    return back()->withErrors([
                        'error' => "Penilaian untuk soal isian belum lengkap!"
                    ])->withInput();
                }

                $j->is_correct = (bool)$nilaiInput;
                $j->save();

                if ($j->is_correct) {
                    $total++;
                }
            }
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

    public function editLocation()
    {
        session()->forget('errors');
        session()->forget('_old_input');

        $info = InfoLokasi::first() ?? new InfoLokasi();
        $lokasi = Lokasi::first() ?? new Lokasi();

        return view('providerloc', [
            'info' => $info,
            'lokasi' => $lokasi,
        ]);
    }

    public function updateLocation(Request $request)
    {
        $request->validate([
            'lat' => 'required',
            'lng' => 'required',
        ]);

        $shelter = Lokasi::first();
        $shelter->lat = $request->lat;
        $shelter->lng = $request->lng;
        $shelter->save();

        return back()->with('success', 'Lokasi shelter berhasil diperbarui!');
    }
    public function updateAll(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string',
            'no_hp' => 'required|digits_between:8,15',
            'jam_buka' => 'required',
            'jam_tutup' => 'required',
            'lat' => 'required',
            'lng' => 'required',
        ],
        [
            'alamat.required' => 'Alamat tidak boleh kosong.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
            'no_hp.digits_between' => 'Nomor HP harus berisi 8–15 digit angka.',
            'jam_buka.required' => 'Jam buka harus diisi.',
            'jam_tutup.required' => 'Jam tutup harus diisi.',
        ]);

        if ($request->jam_tutup <= $request->jam_buka) {
            return back()->withErrors([
                'jam_tutup' => 'Jam tutup harus lebih besar dari jam buka!'
            ]);
        }

        $info = InfoLokasi::first();

        if (!$info) {
            $info = new InfoLokasi();
        }

        $info->alamat = $request->alamat;
        $info->no_hp = $request->no_hp;
        $info->jam_buka = $request->jam_buka;
        $info->jam_tutup = $request->jam_tutup;
        $info->save();

        $lokasi = Lokasi::first();

        if (!$lokasi) {
            $lokasi = new Lokasi();
        }

        $lokasi->lat = $request->lat;
        $lokasi->lng = $request->lng;
        $lokasi->save();


        return back()->with('success', 'Data lokasi berhasil diperbarui!');
    }

}
