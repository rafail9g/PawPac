<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Kucing;
use App\Models\Pengguna;


class AdoptionController extends Controller
{
    public function index()
    {
        $adopsi = Adoption::with('user', 'kucing')->get();
        return view('admin.adopsi.index', compact('adopsi'));
    }

    public function updateStatus($id, $status)
    {
        $adopsi = Adoption::findOrFail($id);
        $adopsi->status = $status;
        $adopsi->save();

        if ($status == 'approved') {
            $adopsi->kucing->update(['status' => 'adopted']);
        }

        return back()->with('success', 'Status berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Adoption::findOrFail($id)->delete();
        return back()->with('success', 'Data adopt berhasil dihapus!');
    }
}
