<?php

namespace App\Http\Controllers\Magang;

use App\Models\PenilaianAkhir;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenilaianAkhirController extends Controller
{
    public function index($magangId)
    {
        $penilaian = PenilaianAkhir::where('data_magang_id', $magangId)->first();
        return view('magang.penilaian.index', compact('penilaian', 'magangId'));
    }

    public function create($magangId)
    {
        return view('magang.penilaian.create', compact('magangId'));
    }

    public function store(Request $request, $magangId)
    {
        $data = $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'umpan_balik' => 'nullable',
            'path_surat_nilai' => 'nullable',
        ]);
        $data['data_magang_id'] = $magangId;
        PenilaianAkhir::create($data);
        return redirect()->route('penilaian.index', $magangId)->with('success', 'Penilaian akhir berhasil dibuat');
    }

    public function edit($magangId, $id)
    {
        $penilaian = PenilaianAkhir::findOrFail($id);
        return view('magang.penilaian.edit', compact('penilaian', 'magangId'));
    }

    public function update(Request $request, $magangId, $id)
    {
        $penilaian = PenilaianAkhir::findOrFail($id);
        $data = $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
            'umpan_balik' => 'nullable',
            'path_surat_nilai' => 'nullable',
        ]);
        $penilaian->update($data);
        return redirect()->route('penilaian.index', $magangId)->with('success', 'Penilaian akhir berhasil diupdate');
    }

    public function destroy($magangId, $id)
    {
        $penilaian = PenilaianAkhir::findOrFail($id);
        $penilaian->delete();
        return redirect()->route('penilaian.index', $magangId)->with('success', 'Penilaian akhir berhasil dihapus');
    }
}
