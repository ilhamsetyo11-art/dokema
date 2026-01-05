<x-admin-layouts>
    <x-slot name="header">
        Detail Laporan Kegiatan
    </x-slot>

    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-medium text-gray-900">Detail Laporan Kegiatan</h2>
                <a href="{{ route('laporan.index') }}" class="text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </div>

        <div class="p-6">
            <!-- Status Badge -->
            <div class="mb-6">
                <span class="inline-flex px-3 py-1.5 text-sm font-semibold rounded-full 
                @if ($laporan->status_verifikasi === 'verified') bg-green-100 text-green-800
                @elseif($laporan->status_verifikasi === 'pending') bg-yellow-100 text-yellow-800
                @elseif($laporan->status_verifikasi === 'rejected') bg-red-100 text-red-800
                @else bg-gray-100 text-gray-800 @endif">
                    {{ ucfirst($laporan->status_verifikasi) }}
                </span>
            </div>

            <!-- Informasi Peserta -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Informasi Peserta</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Nama</p>
                        <p class="text-sm font-medium text-gray-900">{{ $laporan->dataMagang->profilPeserta->nama }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Universitas</p>
                        <p class="text-sm font-medium text-gray-900">{{ $laporan->dataMagang->profilPeserta->universitas }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Pembimbing</p>
                        <p class="text-sm font-medium text-gray-900">
                            {{ $laporan->dataMagang->pembimbing ? $laporan->dataMagang->pembimbing->name : '-' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Tanggal Laporan</p>
                        <p class="text-sm font-medium text-gray-900">
                            {{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d F Y') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Deskripsi Kegiatan -->
            <div class="mb-6">
                <h3 class="text-sm font-medium text-gray-700 mb-2">Deskripsi Kegiatan</h3>
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $laporan->deskripsi }}</p>
                </div>
            </div>

            <!-- Lampiran -->
            @if ($laporan->path_lampiran)
                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Lampiran</h3>
                    <div class="flex items-center gap-2">
                        <a href="{{ asset('storage/' . $laporan->path_lampiran) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.586-6.586a4 4 0 00-5.656-5.656l-6.586 6.586a6 6 0 008.486 8.486L20.5 13" />
                            </svg>
                            Lihat Lampiran
                        </a>
                    </div>
                </div>
            @endif

            <!-- Informasi Verifikasi -->
            @if ($laporan->verified_at)
                <div class="mb-6 p-4 border-2 rounded-lg
                @if ($laporan->status_verifikasi === 'verified') border-green-300 bg-green-50
                @elseif($laporan->status_verifikasi === 'rejected') border-red-300 bg-red-50
                @else border-gray-300 bg-gray-50 @endif">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Informasi Verifikasi</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                        <div>
                            <p class="text-sm text-gray-600">Diverifikasi oleh</p>
                            <p class="text-sm font-medium text-gray-900">
                                {{ $laporan->verifiedBy ? $laporan->verifiedBy->name : '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tanggal Verifikasi</p>
                            <p class="text-sm font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($laporan->verified_at)->format('d F Y H:i') }}
                            </p>
                        </div>
                    </div>
                    @if ($laporan->catatan_verifikasi)
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Catatan</p>
                            <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $laporan->catatan_verifikasi }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Action Buttons untuk Pembimbing -->
            @if (Auth::user()->role === 'pembimbing' && $laporan->status_verifikasi === 'pending')
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <form action="{{ route('laporan.approve', $laporan->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-medium rounded hover:bg-green-700 transition" onclick="return confirm('Apakah Anda yakin ingin menyetujui laporan ini?')">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Setujui Laporan
                        </button>
                    </form>

                    <button type="button" onclick="openRejectModal()" class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium rounded hover:bg-red-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Tolak Laporan
                    </button>

                    <a href="{{ route('laporan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 font-medium rounded hover:bg-gray-400 transition">
                        Kembali
                    </a>
                </div>
            @else
                <div class="pt-4 border-t border-gray-200">
                    <a href="{{ route('laporan.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Reject Laporan -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium leading-6 text-gray-900 mb-4">Tolak Laporan</h3>
                <form action="{{ route('laporan.reject', $laporan->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="catatan_verifikasi" class="block text-sm font-medium text-gray-700 mb-2">
                            Catatan/Alasan Penolakan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="catatan_verifikasi" name="catatan_verifikasi" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Jelaskan alasan penolakan laporan..." required></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeRejectModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                            Tolak Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function openRejectModal() {
                document.getElementById('rejectModal').classList.remove('hidden');
            }

            function closeRejectModal() {
                const modal = document.getElementById('rejectModal');
                modal.querySelector('form').reset();
                modal.classList.add('hidden');
            }

            // Close modal when clicking outside
            document.getElementById('rejectModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeRejectModal();
                }
            });
        </script>
    @endpush
</x-admin-layouts>
