@props(['penilaian' => null, 'action', 'method' => 'POST', 'magangs' => []])

<div class="bg-white rounded-lg shadow">
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if ($method === 'PUT')
            @method('PUT')
        @endif

        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                {{ $penilaian ? 'Edit Penilaian Akhir' : 'Tambah Penilaian Akhir Baru' }}
            </h3>
            <p class="mt-1 text-sm text-gray-600">
                {{ $penilaian ? 'Perbarui informasi penilaian akhir' : 'Lengkapi formulir untuk menambah penilaian akhir baru' }}
            </p>
        </div>

        <div class="px-6 py-4 space-y-6">
            <!-- Data Magang Selection -->
            <div class="bg-blue-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Informasi Magang</h4>
                <x-admin.form-select name="data_magang_id" label="Pilih Data Magang" required="true" placeholder="Pilih data magang">
                    @foreach ($magangs as $magang)
                        <option value="{{ $magang->id }}" {{ old('data_magang_id', $penilaian->data_magang_id ?? '') == $magang->id ? 'selected' : '' }}>
                            {{ $magang->profilPeserta->user->name ?? 'N/A' }} -
                            {{ $magang->profilPeserta->nim }}
                            ({{ $magang->profilPeserta->universitas }})
                        </option>
                    @endforeach
                </x-admin.form-select>
            </div>

            <!-- Assessment Information -->
            <div class="bg-green-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Informasi Penilaian</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-admin.form-input name="tanggal_penilaian" label="Tanggal Penilaian" type="date" :value="old('tanggal_penilaian', $penilaian->tanggal_penilaian ?? '')" required="true" />

                    <x-admin.form-input name="penilai" label="Nama Penilai" type="text" :value="old('penilai', $penilaian->penilai ?? '')" placeholder="Nama pembimbing atau penilai" required="true" />
                </div>
            </div>

            <!-- Assessment Scores -->
            <div class="bg-yellow-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Aspek Penilaian</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-admin.form-select name="nilai_kedisiplinan" label="Nilai Kedisiplinan (1-100)" required="true" placeholder="Pilih nilai kedisiplinan">
                        @for ($i = 100; $i >= 60; $i -= 5)
                            <option value="{{ $i }}" {{ old('nilai_kedisiplinan', $penilaian->nilai_kedisiplinan ?? '') == $i ? 'selected' : '' }}>
                                {{ $i }} -
                                @if ($i >= 85)
                                    Sangat Baik
                                @elseif($i >= 75)
                                    Baik
                                @elseif($i >= 65)
                                    Cukup
                                @else
                                    Kurang
                                @endif
                            </option>
                        @endfor
                    </x-admin.form-select>

                    <x-admin.form-select name="nilai_keterampilan" label="Nilai Keterampilan (1-100)" required="true" placeholder="Pilih nilai keterampilan">
                        @for ($i = 100; $i >= 60; $i -= 5)
                            <option value="{{ $i }}" {{ old('nilai_keterampilan', $penilaian->nilai_keterampilan ?? '') == $i ? 'selected' : '' }}>
                                {{ $i }} -
                                @if ($i >= 85)
                                    Sangat Baik
                                @elseif($i >= 75)
                                    Baik
                                @elseif($i >= 65)
                                    Cukup
                                @else
                                    Kurang
                                @endif
                            </option>
                        @endfor
                    </x-admin.form-select>

                    <x-admin.form-select name="nilai_komunikasi" label="Nilai Komunikasi (1-100)" required="true" placeholder="Pilih nilai komunikasi">
                        @for ($i = 100; $i >= 60; $i -= 5)
                            <option value="{{ $i }}" {{ old('nilai_komunikasi', $penilaian->nilai_komunikasi ?? '') == $i ? 'selected' : '' }}>
                                {{ $i }} -
                                @if ($i >= 85)
                                    Sangat Baik
                                @elseif($i >= 75)
                                    Baik
                                @elseif($i >= 65)
                                    Cukup
                                @else
                                    Kurang
                                @endif
                            </option>
                        @endfor
                    </x-admin.form-select>

                    <x-admin.form-select name="nilai_inisiatif" label="Nilai Inisiatif (1-100)" required="true" placeholder="Pilih nilai inisiatif">
                        @for ($i = 100; $i >= 60; $i -= 5)
                            <option value="{{ $i }}" {{ old('nilai_inisiatif', $penilaian->nilai_inisiatif ?? '') == $i ? 'selected' : '' }}>
                                {{ $i }} -
                                @if ($i >= 85)
                                    Sangat Baik
                                @elseif($i >= 75)
                                    Baik
                                @elseif($i >= 65)
                                    Cukup
                                @else
                                    Kurang
                                @endif
                            </option>
                        @endfor
                    </x-admin.form-select>

                    <x-admin.form-select name="nilai_kerjasama" label="Nilai Kerjasama (1-100)" required="true" placeholder="Pilih nilai kerjasama">
                        @for ($i = 100; $i >= 60; $i -= 5)
                            <option value="{{ $i }}" {{ old('nilai_kerjasama', $penilaian->nilai_kerjasama ?? '') == $i ? 'selected' : '' }}>
                                {{ $i }} -
                                @if ($i >= 85)
                                    Sangat Baik
                                @elseif($i >= 75)
                                    Baik
                                @elseif($i >= 65)
                                    Cukup
                                @else
                                    Kurang
                                @endif
                            </option>
                        @endfor
                    </x-admin.form-select>
                </div>

                @if ($penilaian)
                    <!-- Nilai Akhir Display -->
                    <div class="mt-6 p-4 bg-white rounded-lg border">
                        <div class="text-center">
                            <span class="text-sm text-gray-500">Nilai Akhir:</span>
                            <div class="text-2xl font-bold text-blue-600">
                                {{ number_format(($penilaian->nilai_kedisiplinan + $penilaian->nilai_keterampilan + $penilaian->nilai_komunikasi + $penilaian->nilai_inisiatif + $penilaian->nilai_kerjasama) / 5, 1) }}
                            </div>
                            <div class="text-sm text-gray-500">
                                @php
                                    $average = ($penilaian->nilai_kedisiplinan + $penilaian->nilai_keterampilan + $penilaian->nilai_komunikasi + $penilaian->nilai_inisiatif + $penilaian->nilai_kerjasama) / 5;
                                @endphp
                                @if ($average >= 85)
                                    <span class="text-green-600 font-medium">A - Sangat Baik</span>
                                @elseif($average >= 75)
                                    <span class="text-blue-600 font-medium">B - Baik</span>
                                @elseif($average >= 65)
                                    <span class="text-yellow-600 font-medium">C - Cukup</span>
                                @else
                                    <span class="text-red-600 font-medium">D - Kurang</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Comments and Feedback -->
            <div class="bg-purple-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Komentar dan Saran</h4>
                <div class="space-y-6">
                    <x-admin.form-textarea name="komentar" label="Komentar Umum" :value="old('komentar', $penilaian->komentar ?? '')" placeholder="Berikan komentar umum tentang kinerja peserta magang..." rows="4" required="true" />

                    <x-admin.form-textarea name="saran_perbaikan" label="Saran Perbaikan" :value="old('saran_perbaikan', $penilaian->saran_perbaikan ?? '')" placeholder="Berikan saran untuk perbaikan di masa mendatang..." rows="3" />

                    <x-admin.form-textarea name="kelebihan" label="Kelebihan Peserta" :value="old('kelebihan', $penilaian->kelebihan ?? '')" placeholder="Sebutkan kelebihan atau poin positif dari peserta..." rows="3" />
                </div>
            </div>

            <!-- Document Upload -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Dokumen Penilaian</h4>
                <div>
                    <x-input-label for="path_sertifikat" value="Sertifikat atau Dokumen Penilaian (PDF)" />
                    <input type="file" name="path_sertifikat" id="path_sertifikat" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" accept=".pdf,.jpg,.jpeg,.png">
                    @if ($penilaian && $penilaian->path_sertifikat)
                        <p class="mt-1 text-xs text-gray-500">
                            File saat ini:
                            <a href="{{ asset('storage/' . $penilaian->path_sertifikat) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                Lihat dokumen
                            </a>
                        </p>
                    @endif
                    @error('path_sertifikat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status -->
            <div>
                <x-admin.form-select name="status_penilaian" label="Status Penilaian" required="true" placeholder="Pilih status penilaian">
                    <option value="draft" {{ old('status_penilaian', $penilaian->status_penilaian ?? 'draft') === 'draft' ? 'selected' : '' }}>
                        Draft
                    </option>
                    <option value="completed" {{ old('status_penilaian', $penilaian->status_penilaian ?? '') === 'completed' ? 'selected' : '' }}>
                        Selesai
                    </option>
                    <option value="approved" {{ old('status_penilaian', $penilaian->status_penilaian ?? '') === 'approved' ? 'selected' : '' }}>
                        Disetujui
                    </option>
                </x-admin.form-select>
            </div>

            @if ($penilaian)
                <!-- Status Information -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Informasi Penilaian</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Dibuat:</span>
                            <span class="font-medium">{{ $penilaian->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Terakhir update:</span>
                            <span class="font-medium">{{ $penilaian->updated_at->format('d M Y H:i') }}</span>
                        </div>
                        @if ($penilaian->datamagang)
                            <div>
                                <span class="text-gray-500">Peserta:</span>
                                <span class="font-medium">{{ $penilaian->datamagang->profilPeserta->user->name ?? 'N/A' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Periode Magang:</span>
                                <span class="font-medium">
                                    {{ \Carbon\Carbon::parse($penilaian->datamagang->tanggal_mulai)->format('d M Y') }} -
                                    {{ \Carbon\Carbon::parse($penilaian->datamagang->tanggal_selesai)->format('d M Y') }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3">
            <a href="{{ route('penilaian.index') }}" class="inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Batal
            </a>
            <button type="submit" class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ $penilaian ? 'Update Penilaian' : 'Simpan Penilaian' }}
            </button>
        </div>
    </form>
</div>
