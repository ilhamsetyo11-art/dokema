@props(['logBimbingan' => null, 'action', 'method' => 'POST', 'magangs' => []])

<div class="bg-white rounded-lg shadow">
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if ($method === 'PUT')
            @method('PUT')
        @endif

        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                {{ $logBimbingan ? 'Edit Log Bimbingan' : 'Tambah Log Bimbingan Baru' }}
            </h3>
            <p class="mt-1 text-sm text-gray-600">
                {{ $logBimbingan ? 'Perbarui informasi log bimbingan' : 'Lengkapi formulir untuk menambah log bimbingan baru' }}
            </p>
        </div>

        <div class="px-6 py-4 space-y-6">
            <!-- Data Magang Selection -->
            <div class="bg-blue-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Informasi Magang</h4>
                <x-admin.form-select name="data_magang_id" label="Pilih Data Magang" required="true" placeholder="Pilih data magang">
                    @foreach ($magangs as $magang)
                        <option value="{{ $magang->id }}" {{ old('data_magang_id', $logBimbingan->data_magang_id ?? '') == $magang->id ? 'selected' : '' }}>
                            {{ $magang->profilPeserta->user->name ?? 'N/A' }} -
                            {{ $magang->profilPeserta->nim }}
                            ({{ $magang->departemen ?? 'Departemen tidak terdaftar' }})
                        </option>
                    @endforeach
                </x-admin.form-select>
            </div>

            <!-- Guidance Information -->
            <div class="bg-green-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Informasi Bimbingan</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-admin.form-input name="tanggal_bimbingan" label="Tanggal Bimbingan" type="date" :value="old('tanggal_bimbingan', $logBimbingan->tanggal_bimbingan ?? '')" required="true" />

                    <x-admin.form-input name="waktu_bimbingan" label="Waktu Bimbingan" type="time" :value="old('waktu_bimbingan', $logBimbingan->waktu_bimbingan ?? '')" required="true" />
                </div>

                <div class="mt-6">
                    <x-admin.form-input name="tempat_bimbingan" label="Tempat Bimbingan" type="text" :value="old('tempat_bimbingan', $logBimbingan->tempat_bimbingan ?? '')" placeholder="Masukkan lokasi bimbingan (ruangan, online, dll)" required="true" />
                </div>
            </div>

            <!-- Discussion Details -->
            <div class="bg-yellow-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Detail Pembahasan</h4>
                <div class="space-y-6">
                    <x-admin.form-textarea name="materi_bimbingan" label="Materi yang Dibahas" :value="old('materi_bimbingan', $logBimbingan->materi_bimbingan ?? '')" placeholder="Jelaskan topik atau materi yang dibahas dalam sesi bimbingan ini..." rows="4" required="true" />

                    <x-admin.form-textarea name="progress_peserta" label="Progress Peserta" :value="old('progress_peserta', $logBimbingan->progress_peserta ?? '')" placeholder="Jelaskan perkembangan atau kemajuan peserta magang..." rows="3" />

                    <x-admin.form-textarea name="kendala_dihadapi" label="Kendala yang Dihadapi" :value="old('kendala_dihadapi', $logBimbingan->kendala_dihadapi ?? '')" placeholder="Jelaskan kendala atau kesulitan yang dihadapi peserta (opsional)..." rows="3" />

                    <x-admin.form-textarea name="saran_pembimbing" label="Saran dan Masukan Pembimbing" :value="old('saran_pembimbing', $logBimbingan->saran_pembimbing ?? '')" placeholder="Saran, masukan, atau arahan dari pembimbing..." rows="3" required="true" />

                    <x-admin.form-textarea name="rencana_selanjutnya" label="Rencana Kegiatan Selanjutnya" :value="old('rencana_selanjutnya', $logBimbingan->rencana_selanjutnya ?? '')" placeholder="Rencana atau target untuk periode selanjutnya..." rows="3" />
                </div>
            </div>

            <!-- File Upload -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Dokumen Pendukung</h4>
                <div>
                    <x-input-label for="path_dokumentasi" value="Dokumentasi Bimbingan (Foto/PDF)" />
                    <input type="file" name="path_dokumentasi" id="path_dokumentasi" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                    @if ($logBimbingan && $logBimbingan->path_dokumentasi)
                        <p class="mt-1 text-xs text-gray-500">
                            File saat ini:
                            <a href="{{ asset('storage/' . $logBimbingan->path_dokumentasi) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                Lihat dokumen
                            </a>
                        </p>
                    @endif
                    @error('path_dokumentasi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status and Rating -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-admin.form-select name="status" label="Status Bimbingan" required="true" placeholder="Pilih status bimbingan">
                    <option value="scheduled" {{ old('status', $logBimbingan->status ?? 'scheduled') === 'scheduled' ? 'selected' : '' }}>
                        Terjadwal
                    </option>
                    <option value="completed" {{ old('status', $logBimbingan->status ?? '') === 'completed' ? 'selected' : '' }}>
                        Selesai
                    </option>
                    <option value="cancelled" {{ old('status', $logBimbingan->status ?? '') === 'cancelled' ? 'selected' : '' }}>
                        Dibatalkan
                    </option>
                </x-admin.form-select>

                <x-admin.form-select name="rating_bimbingan" label="Rating Sesi Bimbingan" placeholder="Pilih rating (opsional)">
                    <option value="">-- Pilih Rating --</option>
                    <option value="5" {{ old('rating_bimbingan', $logBimbingan->rating_bimbingan ?? '') == '5' ? 'selected' : '' }}>
                        ⭐⭐⭐⭐⭐ Sangat Baik
                    </option>
                    <option value="4" {{ old('rating_bimbingan', $logBimbingan->rating_bimbingan ?? '') == '4' ? 'selected' : '' }}>
                        ⭐⭐⭐⭐ Baik
                    </option>
                    <option value="3" {{ old('rating_bimbingan', $logBimbingan->rating_bimbingan ?? '') == '3' ? 'selected' : '' }}>
                        ⭐⭐⭐ Cukup
                    </option>
                    <option value="2" {{ old('rating_bimbingan', $logBimbingan->rating_bimbingan ?? '') == '2' ? 'selected' : '' }}>
                        ⭐⭐ Kurang
                    </option>
                    <option value="1" {{ old('rating_bimbingan', $logBimbingan->rating_bimbingan ?? '') == '1' ? 'selected' : '' }}>
                        ⭐ Sangat Kurang
                    </option>
                </x-admin.form-select>
            </div>

            @if ($logBimbingan)
                <!-- Status Information -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Informasi Log Bimbingan</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Dibuat:</span>
                            <span class="font-medium">{{ $logBimbingan->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Terakhir update:</span>
                            <span class="font-medium">{{ $logBimbingan->updated_at->format('d M Y H:i') }}</span>
                        </div>
                        @if ($logBimbingan->datamagang)
                            <div>
                                <span class="text-gray-500">Peserta:</span>
                                <span class="font-medium">{{ $logBimbingan->datamagang->profilPeserta->user->name ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Pembimbing:</span>
                                <span class="font-medium">{{ $logBimbingan->datamagang->pembimbing ?? 'Belum ditentukan' }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3">
            <a href="{{ route('bimbingan.index') }}" class="inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Batal
            </a>
            <button type="submit" class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ $logBimbingan ? 'Update Log Bimbingan' : 'Simpan Log Bimbingan' }}
            </button>
        </div>
    </form>
</div>
