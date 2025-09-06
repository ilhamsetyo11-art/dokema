<?php

namespace App\Http\Controllers\Magang;

use App\Models\PenilaianAkhir;
use App\Models\DataMagang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenilaianAkhirController extends Controller
{
    public function index()
    {
        // Ambil semua penilaian dengan relasi ke data magang dan profil peserta
        $penilaianList = PenilaianAkhir::with(['dataMagang.profilPeserta', 'dataMagang.pembimbing'])
            ->latest()
            ->paginate(10);

        return view('magang.penilaian.index', compact('penilaianList'));
    }

    public function create($magangId)
    {
        $dataMagang = DataMagang::with('profilPeserta')->findOrFail($magangId);
        return view('magang.penilaian.create', compact('magangId', 'dataMagang'));
    }

    public function store(Request $request, $magangId)
    {
        $data = $request->validate([
            'nilai' => 'required|numeric|min:0|max:4',
            'umpan_balik' => 'nullable|string',
            'path_surat_nilai' => 'nullable|string',
        ]);
        $data['data_magang_id'] = $magangId;
        PenilaianAkhir::create($data);
        return redirect()->route('penilaian.index')->with('success', 'Penilaian akhir berhasil dibuat');
    }

    public function edit($magangId, $id)
    {
        $penilaian = PenilaianAkhir::with('dataMagang.profilPeserta')->findOrFail($id);
        return view('magang.penilaian.edit', compact('penilaian', 'magangId'));
    }

    public function update(Request $request, $magangId, $id)
    {
        $penilaian = PenilaianAkhir::findOrFail($id);
        $data = $request->validate([
            'nilai' => 'required|numeric|min:0|max:4',
            'umpan_balik' => 'nullable|string',
            'path_surat_nilai' => 'nullable|string',
        ]);
        $penilaian->update($data);
        return redirect()->route('penilaian.index')->with('success', 'Penilaian akhir berhasil diupdate');
    }

    public function destroy($magangId, $id)
    {
        $penilaian = PenilaianAkhir::findOrFail($id);
        $penilaian->delete();
        return redirect()->route('penilaian.index')->with('success', 'Penilaian akhir berhasil dihapus');
    }
}
