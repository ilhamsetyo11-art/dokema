<x-admin-layouts>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Pengaturan Sistem</h1>
                <p class="mt-2 text-sm text-gray-600">Kelola kuota magang dan pengaturan sistem lainnya</p>
            </div>

            <!-- Settings Form -->
            <div class="bg-white shadow-sm rounded-lg p-6">
                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Quota Setting -->
                    <div class="mb-6">
                        <label for="magang_quota" class="block text-sm font-medium text-gray-700 mb-2">
                            Kuota Maksimal Magang
                        </label>
                        <input type="number" name="magang_quota" id="magang_quota" value="{{ old('magang_quota', $settings['magang_quota']->value ?? 20) }}" min="1" max="100" required class="mt-1 block w-full md:w-1/3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <p class="mt-2 text-sm text-gray-500">
                            Jumlah maksimal peserta magang yang dapat diterima secara bersamaan
                        </p>
                        @error('magang_quota')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Auto Assign Supervisor -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Penugasan Pembimbing Otomatis
                        </label>
                        <div class="flex items-center">
                            <input type="checkbox" name="auto_assign_supervisor" id="auto_assign_supervisor" value="1" {{ old('auto_assign_supervisor', $settings['auto_assign_supervisor']->value ?? true) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <label for="auto_assign_supervisor" class="ml-3 text-sm text-gray-600">
                                Otomatis menugaskan pembimbing saat approval berdasarkan beban kerja
                            </label>
                        </div>
                        @error('auto_assign_supervisor')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Quota Info -->
                    <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <h3 class="text-sm font-medium text-blue-900 mb-2">Informasi Kuota Saat Ini</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-xs text-blue-700">Kuota Maksimal</p>
                                <p class="text-2xl font-bold text-blue-900">{{ $settings['magang_quota']->value ?? 20 }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-blue-700">Magang Aktif</p>
                                <p class="text-2xl font-bold text-blue-900">
                                    {{ \App\Models\DataMagang::whereIn('workflow_status', ['approved', 'in_progress'])->count() }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-blue-700">Sisa Kuota</p>
                                <p class="text-2xl font-bold text-blue-900">
                                    {{ max(0, ($settings['magang_quota']->value ?? 20) - \App\Models\DataMagang::whereIn('workflow_status', ['approved', 'in_progress'])->count()) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-sm text-white hover:bg-blue-700">
                            Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Additional Settings Section -->
            <div class="mt-8 bg-white shadow-sm rounded-lg p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">Pengaturan Lanjutan</h2>
                <div class="space-y-4">
                    <div class="flex items-center justify-between py-3 border-b border-gray-200">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Auto-generate Log Bimbingan</h3>
                            <p class="text-sm text-gray-500">Otomatis membuat log bimbingan saat laporan dibuat</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Aktif
                        </span>
                    </div>
                    <div class="flex items-center justify-between py-3 border-b border-gray-200">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Workflow Transition Logging</h3>
                            <p class="text-sm text-gray-500">Mencatat semua perubahan status workflow</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Aktif
                        </span>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <div>
                            <h3 class="text-sm font-medium text-gray-900">Auto-create User Account</h3>
                            <p class="text-sm text-gray-500">Otomatis membuat akun saat HR menyetujui permohonan</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Aktif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layouts>
