<?php

namespace App\Http\Controllers\Magang;

use App\Models\LaporanKegiatan;
use App\Models\DataMagang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LaporanKegiatanController extends Controller
{
    public function index($magangId)
    {
        $laporan = LaporanKegiatan::where('data_magang_id', $magangId)->get();
        return view('magang.laporan.index', compact('laporan', 'magangId'));
    }

    public function create($magangId)
    {
        return view('magang.laporan.create', compact('magangId'));
    }

    public function store(Request $request, $magangId)
    {
        $data = $request->validate([
            'tanggal_laporan' => 'required|date',
            'deskripsi' => 'required',
            'path_lampiran' => 'nullable',
        ]);
        $data['data_magang_id'] = $magangId;
        $data['status_verifikasi'] = 'menunggu';
        LaporanKegiatan::create($data);
        return redirect()->route('laporan.index', $magangId)->with('success', 'Laporan berhasil dibuat');
    }
}
