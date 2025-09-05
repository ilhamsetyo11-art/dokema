<?php

namespace App\Http\Controllers\Magang;

use App\Models\DataMagang;
use App\Models\ProfilPeserta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataMagangController extends Controller
{
    public function index()
    {
        $profil = ProfilPeserta::where('user_id', Auth::id())->first();
        $magang = $profil ? $profil->dataMagang : collect();
        return view('magang.magang.index', compact('magang'));
    }

    public function create()
    {
        return view('magang.magang.create');
    }

    public function store(Request $request)
    {
        $profil = ProfilPeserta::where('user_id', Auth::id())->firstOrFail();
        $data = $request->validate([
            'path_surat_permohonan' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);
        $data['profil_peserta_id'] = $profil->id;
        $data['status'] = 'menunggu';
        DataMagang::create($data);
        return redirect()->route('magang.index')->with('success', 'Data magang berhasil dibuat');
    }
}
