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
        $pembimbings = \App\Models\User::where('role', 'pembimbing')->get();
        $pesertas = \App\Models\ProfilPeserta::all();
        return view('magang.magang.create', compact('pembimbings', 'pesertas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'profil_peserta_id' => 'required|exists:profil_peserta,id',
            'pembimbing_id' => 'nullable|exists:users,id',
            'path_surat_permohonan' => 'required',
            'path_surat_balasan' => 'nullable',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:menunggu,diterima,ditolak',
        ]);
        DataMagang::create($data);
        return redirect()->route('magang.index')->with('success', 'Data magang berhasil dibuat');
    }

    public function edit($id)
    {
        $magang = DataMagang::findOrFail($id);
        $pembimbings = \App\Models\User::where('role', 'pembimbing')->get();
        $pesertas = \App\Models\ProfilPeserta::all();
        return view('magang.magang.edit', compact('magang', 'pembimbings', 'pesertas'));
    }

    public function update(Request $request, $id)
    {
        $magang = DataMagang::findOrFail($id);
        $data = $request->validate([
            'profil_peserta_id' => 'required|exists:profil_peserta,id',
            'pembimbing_id' => 'nullable|exists:users,id',
            'path_surat_permohonan' => 'required',
            'path_surat_balasan' => 'nullable',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:menunggu,diterima,ditolak',
        ]);
        $magang->update($data);
        return redirect()->route('magang.index')->with('success', 'Data magang berhasil diupdate');
    }

    public function destroy($id)
    {
        $magang = DataMagang::findOrFail($id);
        $magang->delete();
        return redirect()->route('magang.index')->with('success', 'Data magang berhasil dihapus');
    }
}
