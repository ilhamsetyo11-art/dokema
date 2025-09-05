<?php

namespace App\Http\Controllers\Magang;

use App\Models\ProfilPeserta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfilPesertaController extends Controller
{
    public function index()
    {
        $profil = ProfilPeserta::where('user_id', Auth::id())->first();
        return view('magang.profil.index', compact('profil'));
    }

    public function create()
    {
        return view('magang.profil.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nim' => 'required|unique:profil_peserta',
            'universitas' => 'required',
            'jurusan' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'nullable',
        ]);
        $data['user_id'] = Auth::id();
        ProfilPeserta::create($data);
        return redirect()->route('profil.index')->with('success', 'Profil berhasil dibuat');
    }

    public function edit()
    {
        $profil = ProfilPeserta::where('user_id', Auth::id())->firstOrFail();
        return view('magang.profil.edit', compact('profil'));
    }

    public function update(Request $request)
    {
        $profil = ProfilPeserta::where('user_id', Auth::id())->firstOrFail();
        $data = $request->validate([
            'nim' => 'required|unique:profil_peserta,nim,' . $profil->id,
            'universitas' => 'required',
            'jurusan' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'nullable',
        ]);
        $profil->update($data);
        return redirect()->route('profil.index')->with('success', 'Profil berhasil diupdate');
    }

    public function destroy()
    {
        $profil = ProfilPeserta::where('user_id', Auth::id())->firstOrFail();
        $profil->delete();
        return redirect()->route('profil.index')->with('success', 'Profil berhasil dihapus');
    }
}
