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
}
