@props(['magang' => null, 'action', 'method' => 'POST', 'profils' => []])

<div class="bg-white rounded-lg shadow">
    <form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @if ($method === 'PUT')
            @method('PUT')
        @endif

        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                {{ $magang ? 'Edit Data Magang' : 'Tambah Data Magang Baru' }}
            </h3>
            <p class="mt-1 text-sm text-gray-600">
                {{ $magang ? 'Perbarui informasi data magang' : 'Lengkapi formulir untuk menambah data magang baru' }}
            </p>
        </div>

        <div class="px-6 py-4 space-y-6">
            <!-- Peserta Selection -->
            <div class="bg-blue-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Informasi Peserta</h4>
                <x-admin.form-select name="profil_peserta_id" label="Pilih Peserta Magang" required="true" placeholder="Pilih profil peserta">
                    @foreach ($profils as $profil)
                        <option value="{{ $profil->id }}" {{ old('profil_peserta_id', $magang->profil_peserta_id ?? '') == $profil->id ? 'selected' : '' }}>
                            {{ $profil->user->name ?? 'N/A' }} - {{ $profil->nim }} ({{ $profil->universitas }})
                        </option>
                    @endforeach
                </x-admin.form-select>
            </div>

            <!-- Period Information -->
            <div class="bg-green-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Periode Magang</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-admin.form-input name="tanggal_mulai" label="Tanggal Mulai" type="date" :value="old('tanggal_mulai', $magang->tanggal_mulai ?? '')" required="true" />

                    <x-admin.form-input name="tanggal_selesai" label="Tanggal Selesai" type="date" :value="old('tanggal_selesai', $magang->tanggal_selesai ?? '')" required="true" />
                </div>
            </div>

            <!-- Assignment Information -->
            <div class="bg-yellow-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Penempatan</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-admin.form-input name="departemen" label="Departemen" type="text" :value="old('departemen', $magang->departemen ?? '')" placeholder="Nama departemen" />

                    <x-admin.form-input name="pembimbing" label="Nama Pembimbing" type="text" :value="old('pembimbing', $magang->pembimbing ?? '')" placeholder="Nama pembimbing" />
                </div>
            </div>

            <!-- Documents -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Dokumen</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="path_surat_permohonan" value="Surat Permohonan" />
                        <input type="file" name="path_surat_permohonan" id="path_surat_permohonan" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" accept=".pdf,.jpg,.jpeg,.png">
                        @if ($magang && $magang->path_surat_permohonan)
                            <p class="mt-1 text-xs text-gray-500">
                                File saat ini:
                                <a href="{{ asset('storage/' . $magang->path_surat_permohonan) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    Lihat dokumen
                                </a>
                            </p>
                        @endif
                        @error('path_surat_permohonan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <x-input-label for="path_surat_balasan" value="Surat Balasan" />
                        <input type="file" name="path_surat_balasan" id="path_surat_balasan" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" accept=".pdf,.jpg,.jpeg,.png">
                        @if ($magang && $magang->path_surat_balasan)
                            <p class="mt-1 text-xs text-gray-500">
                                File saat ini:
                                <a href="{{ asset('storage/' . $magang->path_surat_balasan) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    Lihat dokumen
                                </a>
                            </p>
                        @endif
                        @error('path_surat_balasan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div>
                <x-admin.form-select name="status" label="Status Magang" required="true" placeholder="Pilih status magang">
                    <option value="pending" {{ old('status', $magang->status ?? '') === 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                    <option value="diterima" {{ old('status', $magang->status ?? '') === 'diterima' ? 'selected' : '' }}>
                        Diterima
                    </option>
                    <option value="ditolak" {{ old('status', $magang->status ?? '') === 'ditolak' ? 'selected' : '' }}>
                        Ditolak
                    </option>
                </x-admin.form-select>
            </div>

            @if ($magang)
                <!-- Status Information -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Informasi Data Magang</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Dibuat:</span>
                            <span class="font-medium">{{ $magang->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Terakhir update:</span>
                            <span class="font-medium">{{ $magang->updated_at->format('d M Y H:i') }}</span>
                        </div>
                        @if ($magang->status === 'diterima')
                            <div class="md:col-span-2">
                                <span class="text-gray-500">Durasi:</span>
                                <span class="font-medium">
                                    {{ \Carbon\Carbon::parse($magang->tanggal_mulai)->diffInDays(\Carbon\Carbon::parse($magang->tanggal_selesai)) }} hari
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3">
            <a href="{{ route('magang.index') }}" class="inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Batal
            </a>
            <button type="submit" class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ $magang ? 'Update Data Magang' : 'Simpan Data Magang' }}
            </button>
        </div>
    </form>
</div>
