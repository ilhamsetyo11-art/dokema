<?php

namespace App\Http\Controllers\Magang;

use App\Models\DataMagang;
use App\Models\ProfilPeserta;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class WorkflowMagangController extends Controller
{
    /**
     * Display workflow approval page
     */
    public function index()
    {
        // Get pending applications with real-time eager loading (Issue #5)
        $pendingApplications = DataMagang::with(['profilPeserta.user', 'pembimbing'])
            ->whereIn('workflow_status', ['submitted', 'under_review'])
            ->latest()
            ->get();

        // Get quota information from Settings (Issue #4)
        $quota = $this->checkQuota();

        // Get supervisors with current workload
        $supervisors = User::where('role', 'pembimbing')
            ->withCount(['magangDibimbing' => function ($query) {
                $query->whereIn('workflow_status', ['approved', 'in_progress']);
            }])
            ->orderBy('magang_dibimbing_count', 'asc')
            ->get();

        return view('workflow.approval', compact('pendingApplications', 'quota', 'supervisors'));
    }

    /**
     * Handle approval/rejection workflow
     * Issue #3: Auto-create user account on approval
     */
    public function processApplication(Request $request, $magangId)
    {
        $magang = DataMagang::with(['profilPeserta.user', 'pembimbing'])->findOrFail($magangId);

        $request->validate([
            'action' => 'required|in:approve,reject',
            'rejection_reason' => 'required_if:action,reject|string',
            'pembimbing_id' => 'required_if:action,approve|exists:users,id',
            'surat_balasan' => 'required_if:action,approve|file|mimes:pdf'
        ]);

        if ($request->action === 'approve') {
            // Check quota before approval
            $quota = $this->checkQuota();
            if ($quota['is_full']) {
                return redirect()->back()->with('error', 'Kuota magang sudah penuh. Tidak dapat menyetujui permohonan baru.');
            }

            // Approve the application
            $suratBalasanPath = $request->file('surat_balasan')->store('surat_balasan', 'public');

            // Issue #3: Auto-create user account when approved
            $user = null;
            if (!$magang->profilPeserta->user_id) {
                $randomPassword = \Illuminate\Support\Str::random(12);

                $user = User::create([
                    'name' => $magang->profilPeserta->nama,
                    'email' => $magang->profilPeserta->email,
                    'password' => \Illuminate\Support\Facades\Hash::make($randomPassword),
                    'role' => 'magang',
                ]);

                // Link user to profil
                $magang->profilPeserta->update(['user_id' => $user->id]);

                // TODO: Send email with credentials
                // Mail::to($user->email)->send(new AccountCreated($user, $randomPassword));
            }

            $magang->update([
                'status' => 'diterima',
                'workflow_status' => 'approved',
                'pembimbing_id' => $request->pembimbing_id,
                'path_surat_balasan' => $suratBalasanPath,
                'tanggal_persetujuan' => now()
            ]);

            $message = 'Permohonan magang telah disetujui dan pembimbing telah ditugaskan.';
            if ($user) {
                $message .= ' Akun pengguna telah dibuat otomatis.';
            }

            // Send notification to student
            // Mail::to($magang->profilPeserta->email)->send(new MagangApproved($magang));

            return redirect()->back()->with('success', $message);
        } else {
            // Reject the application  
            $magang->update([
                'status' => 'ditolak',
                'workflow_status' => 'rejected',
                'catatan_penolakan' => $request->rejection_reason,
                'tanggal_penolakan' => now()
            ]);

            // Send notification to student
            // Mail::to($magang->profilPeserta->email)->send(new MagangRejected($magang));

            return redirect()->back()->with('success', 'Permohonan magang telah ditolak.');
        }
    }

    /**
     * Check quota for internship (Issue #4: Use Settings model)
     */
    public function checkQuota()
    {
        $activeInterns = DataMagang::whereIn('workflow_status', ['approved', 'in_progress'])
            ->count();

        $maxQuota = \App\Models\Setting::get('magang_quota', 20);

        return [
            'current' => $activeInterns,
            'max' => $maxQuota,
            'available' => max(0, $maxQuota - $activeInterns),
            'is_full' => $activeInterns >= $maxQuota
        ];
    }

    /**
     * Auto-assign supervisor based on workload
     */
    public function autoAssignSupervisor()
    {
        $supervisors = User::where('role', 'pembimbing')
            ->withCount(['magangDibimbing' => function ($query) {
                $query->where('status', 'diterima');
            }])
            ->orderBy('magang_dibimbing_count', 'asc')
            ->first();

        return $supervisors;
    }
}
