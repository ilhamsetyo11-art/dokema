@props(['laporan' => null, 'action', 'method' => 'POST', 'magangs' => []])

<div class="bg-white rounded-lg shadow">
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if ($method === 'PUT')
            @method('PUT')
        @endif

        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                {{ $laporan ? 'Edit Laporan Kegiatan' : 'Tambah Laporan Kegiatan Baru' }}
            </h3>
            <p class="mt-1 text-sm text-gray-600">
                {{ $laporan ? 'Perbarui informasi laporan kegiatan' : 'Lengkapi formulir untuk menambah laporan kegiatan baru' }}
            </p>
        </div>

        <div class="px-6 py-4 space-y-6">
            <!-- Data Magang Selection -->
            <div class="bg-blue-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Informasi Magang</h4>
                <x-admin.form-select name="data_magang_id" label="Pilih Data Magang" required="true" placeholder="Pilih data magang">
                    @foreach ($magangs as $magang)
                        <option value="{{ $magang->id }}" {{ old('data_magang_id', $laporan->data_magang_id ?? '') == $magang->id ? 'selected' : '' }}>
                            {{ $magang->profilPeserta->user->name ?? 'N/A' }} -
                            {{ $magang->profilPeserta->nim }}
                            ({{ \Carbon\Carbon::parse($magang->tanggal_mulai)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($magang->tanggal_selesai)->format('d M Y') }})
                        </option>
                    @endforeach
                </x-admin.form-select>
            </div>

            <!-- Report Information -->
            <div class="bg-green-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Informasi Laporan</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-admin.form-input name="tanggal_laporan" label="Tanggal Laporan" type="date" :value="old('tanggal_laporan', $laporan->tanggal_laporan ?? '')" required="true" />

                    <x-admin.form-select name="minggu_ke" label="Minggu Ke" required="true" placeholder="Pilih minggu">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ old('minggu_ke', $laporan->minggu_ke ?? '') == $i ? 'selected' : '' }}>
                                Minggu {{ $i }}
                            </option>
                        @endfor
                    </x-admin.form-select>
                </div>
            </div>

            <!-- Activity Details -->
            <div class="bg-yellow-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Detail Kegiatan</h4>
                <div class="space-y-6">
                    <x-admin.form-textarea name="kegiatan" label="Kegiatan yang Dilakukan" :value="old('kegiatan', $laporan->kegiatan ?? '')" placeholder="Jelaskan kegiatan yang telah dilakukan pada minggu ini..." rows="4" required="true" />

                    <x-admin.form-textarea name="kendala" label="Kendala yang Dihadapi" :value="old('kendala', $laporan->kendala ?? '')" placeholder="Jelaskan kendala atau kesulitan yang dihadapi (opsional)..." rows="3" />

                    <x-admin.form-textarea name="pencapaian" label="Pencapaian/Hasil" :value="old('pencapaian', $laporan->pencapaian ?? '')" placeholder="Jelaskan pencapaian atau hasil dari kegiatan yang dilakukan..." rows="3" required="true" />
                </div>
            </div>

            <!-- File Upload -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Dokumen Pendukung</h4>
                <div>
                    <x-input-label for="path_file_laporan" value="File Laporan (PDF/Gambar)" />
                    <input type="file" name="path_file_laporan" id="path_file_laporan" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                    @if ($laporan && $laporan->path_file_laporan)
                        <p class="mt-1 text-xs text-gray-500">
                            File saat ini:
                            <a href="{{ asset('storage/' . $laporan->path_file_laporan) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                Lihat dokumen
                            </a>
                        </p>
                    @endif
                    @error('path_file_laporan')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status -->
            <div>
                <x-admin.form-select name="status" label="Status Laporan" required="true" placeholder="Pilih status laporan">
                    <option value="draft" {{ old('status', $laporan->status ?? 'draft') === 'draft' ? 'selected' : '' }}>
                        Draft
                    </option>
                    <option value="submitted" {{ old('status', $laporan->status ?? '') === 'submitted' ? 'selected' : '' }}>
                        Submitted
                    </option>
                    <option value="approved" {{ old('status', $laporan->status ?? '') === 'approved' ? 'selected' : '' }}>
                        Approved
                    </option>
                    <option value="rejected" {{ old('status', $laporan->status ?? '') === 'rejected' ? 'selected' : '' }}>
                        Rejected
                    </option>
                </x-admin.form-select>
            </div>

            @if ($laporan)
                <!-- Status Information -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Informasi Laporan</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Dibuat:</span>
                            <span class="font-medium">{{ $laporan->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Terakhir update:</span>
                            <span class="font-medium">{{ $laporan->updated_at->format('d M Y H:i') }}</span>
                        </div>
                        @if ($laporan->datamagang)
                            <div>
                                <span class="text-gray-500">Peserta:</span>
                                <span class="font-medium">{{ $laporan->datamagang->profilPeserta->user->name ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">NIM:</span>
                                <span class="font-medium">{{ $laporan->datamagang->profilPeserta->nim ?? 'N/A' }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3">
            <a href="{{ route('laporan.index') }}" class="inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Batal
            </a>
            <button type="submit" class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ $laporan ? 'Update Laporan' : 'Simpan Laporan' }}
            </button>
        </div>
    </form>
</div>
