<?php

namespace App\Http\Controllers\Magang;

use App\Models\LogBimbingan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogBimbinganController extends Controller
{
    public function index($magangId)
    {
        $log = LogBimbingan::where('data_magang_id', $magangId)->get();
        return view('magang.bimbingan.index', compact('log', 'magangId'));
    }

    public function create($magangId)
    {
        return view('magang.bimbingan.create', compact('magangId'));
    }

    public function store(Request $request, $magangId)
    {
        $data = $request->validate([
            'waktu_bimbingan' => 'required|date_format:Y-m-d H:i',
            'catatan_peserta' => 'nullable',
            'catatan_pembimbing' => 'nullable',
        ]);
        $data['data_magang_id'] = $magangId;
        LogBimbingan::create($data);
        return redirect()->route('bimbingan.index', $magangId)->with('success', 'Log bimbingan berhasil dibuat');
    }

    public function edit($magangId, $id)
    {
        $log = LogBimbingan::findOrFail($id);
        return view('magang.bimbingan.edit', compact('log', 'magangId'));
    }

    public function update(Request $request, $magangId, $id)
    {
        $log = LogBimbingan::findOrFail($id);
        $data = $request->validate([
            'waktu_bimbingan' => 'required|date_format:Y-m-d H:i',
            'catatan_peserta' => 'nullable',
            'catatan_pembimbing' => 'nullable',
        ]);
        $log->update($data);
        return redirect()->route('bimbingan.index', $magangId)->with('success', 'Log bimbingan berhasil diupdate');
    }

    public function destroy($magangId, $id)
    {
        $log = LogBimbingan::findOrFail($id);
        $log->delete();
        return redirect()->route('bimbingan.index', $magangId)->with('success', 'Log bimbingan berhasil dihapus');
    }
}
