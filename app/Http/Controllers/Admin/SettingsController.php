<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'magang_quota' => 'required|integer|min:1|max:100',
            'auto_assign_supervisor' => 'required|boolean',
        ]);

        Setting::set('magang_quota', $validated['magang_quota'], 'int');
        Setting::set('auto_assign_supervisor', $validated['auto_assign_supervisor'], 'bool');

        return redirect()->route('settings.index')
            ->with('success', 'Pengaturan berhasil disimpan');
    }
}
