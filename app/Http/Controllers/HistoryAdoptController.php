<?php

namespace App\Http\Controllers;

use App\Models\HistoryAdopt;
use Illuminate\Http\Request;

class HistoryAdoptController extends Controller
{
    public function index()
    {
        $history = HistoryAdopt::with(['adopsi.kucing', 'adopsi.adopter'])
            ->latest()
            ->get();

        return view('datahistory', compact('history'));
    }

    public function destroy($id)
    {
        $history = HistoryAdopt::findOrFail($id);
        $history->delete();

        return redirect()->route('admin.history.index')
            ->with('success', 'Data history berhasil dihapus!');
    }

    public function getJson($id)
    {
        $history = HistoryAdopt::with(['adopsi.kucing', 'adopsi.adopter'])->find($id);

        if (!$history) {
            return response()->json(['error' => 'History tidak ditemukan'], 404);
        }

        return response()->json($history);
    }

    public function update(Request $request, $id)
    {
        $history = HistoryAdopt::findOrFail($id);

        $request->validate([
            'catatan' => 'nullable|string',
            'status' => 'required|in:lulus,tidak_lulus'
        ]);

        $history->update([
            'catatan' => $request->catatan,
            'status' => $request->status
        ]);

        return redirect()->route('admin.history.index')
            ->with('success', 'Data history berhasil diperbarui!');
    }
}
