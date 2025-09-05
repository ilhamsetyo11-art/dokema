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
            'surat_permohonan' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'surat_balasan' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:menunggu,diterima,ditolak',
        ]);

        // Simpan file surat permohonan
        if ($request->hasFile('surat_permohonan')) {
            $permohonanPath = $request->file('surat_permohonan')->store('magang/surat_permohonan', 'public');
        } else {
            $permohonanPath = null;
        }
        // Simpan file surat balasan
        if ($request->hasFile('surat_balasan')) {
            $balasanPath = $request->file('surat_balasan')->store('magang/surat_balasan', 'public');
        } else {
            $balasanPath = null;
        }

        DataMagang::create([
            'profil_peserta_id' => $data['profil_peserta_id'],
            'pembimbing_id' => $data['pembimbing_id'],
            'path_surat_permohonan' => $permohonanPath,
            'path_surat_balasan' => $balasanPath,
            'tanggal_mulai' => $data['tanggal_mulai'],
            'tanggal_selesai' => $data['tanggal_selesai'],
            'status' => $data['status'],
        ]);
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
            'surat_permohonan' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'surat_balasan' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|in:menunggu,diterima,ditolak',
        ]);

        // Update file surat permohonan jika ada
        if ($request->hasFile('surat_permohonan')) {
            $permohonanPath = $request->file('surat_permohonan')->store('magang/surat_permohonan', 'public');
        } else {
            $permohonanPath = $magang->path_surat_permohonan;
        }
        // Update file surat balasan jika ada
        if ($request->hasFile('surat_balasan')) {
            $balasanPath = $request->file('surat_balasan')->store('magang/surat_balasan', 'public');
        } else {
            $balasanPath = $magang->path_surat_balasan;
        }

        $magang->update([
            'profil_peserta_id' => $data['profil_peserta_id'],
            'pembimbing_id' => $data['pembimbing_id'],
            'path_surat_permohonan' => $permohonanPath,
            'path_surat_balasan' => $balasanPath,
            'tanggal_mulai' => $data['tanggal_mulai'],
            'tanggal_selesai' => $data['tanggal_selesai'],
            'status' => $data['status'],
        ]);
        return redirect()->route('magang.index')->with('success', 'Data magang berhasil diupdate');
    }

    public function destroy($id)
    {
        $magang = DataMagang::findOrFail($id);
        $magang->delete();
        return redirect()->route('magang.index')->with('success', 'Data magang berhasil dihapus');
    }
}
