<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Kucing;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class AdoptionAdminController extends Controller
{
    public function index()
    {
        $adopsi = Adoption::with(['adopter', 'kucing'])
            ->latest()
            ->get();

        return view('dataadopsi', compact('adopsi'));
    }

    public function getJson($id)
    {
        $adopsi = Adoption::with(['adopter', 'kucing'])->find($id);

        if (!$adopsi) {
            return response()->json(['error' => 'Adopsi tidak ditemukan'], 404);
        }

        return response()->json($adopsi);
    }

    public function update(Request $request, $id)
    {
        $adopsi = Adoption::findOrFail($id);

        $request->validate([
            'adopter_id' => 'required|exists:pengguna,id',
            'kucing_id' => 'required|exists:kucing,id',
            'nilai_quiz' => 'nullable|integer',
            'status' => 'required|in:pending,lulus,tidak_lulus'
        ]);

        $adopsi->update([
            'adopter_id' => $request->adopter_id,
            'kucing_id' => $request->kucing_id,
            'nilai_quiz' => $request->nilai_quiz,
            'status' => $request->status
        ]);

        if ($request->status === 'lulus') {
            $kucing = Kucing::find($request->kucing_id);
            if ($kucing) {
                $kucing->status = 'adopted';
                $kucing->save();
            }
        }

        return redirect()->route('admin.adopsi.index')
            ->with('success', 'Data adopsi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $adopsi = Adoption::findOrFail($id);
        $adopsi->delete();

        return redirect()->route('admin.adopsi.index')
            ->with('success', 'Data adopsi berhasil dihapus!');
    }

    public function updateStatus(Request $request, $id)
    {
        $adopsi = Adoption::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,lulus,tidak_lulus'
        ]);

        $adopsi->status = $request->status;
        $adopsi->save();

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

        return redirect()->route('admin.adopsi.index')
            ->with('success', 'Status adopsi berhasil diperbarui!');
    }

    public function getAdopters()
    {
        $adopters = Pengguna::where('role', 'adopter')->get();
        return response()->json($adopters);
    }

    public function getKucing()
    {
        $kucing = Kucing::all();
        return response()->json($kucing);
    }
}
