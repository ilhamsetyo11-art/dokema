<x-admin-layouts>
    <x-slot name="header">
        Penilaian Akhir
    </x-slot>

    <div class="space-y-6">
        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Header Actions -->
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Daftar Penilaian Akhir</h2>
                <p class="text-gray-600">Kelola penilaian akhir peserta magang</p>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            @if ($penilaianList->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Peserta Magang
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIM
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Universitas
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pembimbing
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nilai
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Periode Magang
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($penilaianList as $index => $penilaian)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $penilaianList->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $penilaian->dataMagang->profilPeserta->nama ?? 'N/A' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $penilaian->dataMagang->profilPeserta->jurusan ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $penilaian->dataMagang->profilPeserta->nim ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ Str::limit($penilaian->dataMagang->profilPeserta->universitas ?? 'N/A', 20) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $penilaian->dataMagang->pembimbing->name ?? 'Belum ditentukan' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-900">
                                            {{ number_format($penilaian->nilai, 2) }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            @if ($penilaian->nilai >= 3.5)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    Sangat Baik
                                                </span>
                                            @elseif($penilaian->nilai >= 3.0)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    Baik
                                                </span>
                                            @elseif($penilaian->nilai >= 2.5)
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Cukup
                                                </span>
                                            @else
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                    Kurang
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div>
                                            {{ $penilaian->dataMagang->tanggal_mulai ? \Carbon\Carbon::parse($penilaian->dataMagang->tanggal_mulai)->format('d M Y') : 'N/A' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            s/d {{ $penilaian->dataMagang->tanggal_selesai ? \Carbon\Carbon::parse($penilaian->dataMagang->tanggal_selesai)->format('d M Y') : 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button onclick="showDetail({{ $penilaian->id }})" class="text-blue-600 hover:text-blue-900">
                                            Lihat Detail
                                        </button>
                                        <a href="{{ route('penilaian.edit', [$penilaian->data_magang_id, $penilaian->id]) }}" class="text-yellow-600 hover:text-yellow-900">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('penilaian.destroy', [$penilaian->data_magang_id, $penilaian->id]) }}" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus penilaian ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-3 border-t border-gray-200">
                    {{ $penilaianList->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada penilaian</h3>
                    <p class="mt-1 text-sm text-gray-500">Belum ada penilaian akhir yang dibuat.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Detail -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Detail Penilaian Akhir</h3>
                    <button onclick="closeDetail()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div id="modalContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDetail(penilaianId) {
            // Find the penilaian data
            const penilaianData = @json($penilaianList->items());
            const penilaian = penilaianData.find(p => p.id === penilaianId);

            if (penilaian) {
                const modalContent = document.getElementById('modalContent');
                modalContent.innerHTML = `
                    <div class="space-y-4">
                        <div>
                            <h4 class="font-semibold text-gray-900">Peserta Magang:</h4>
                            <p class="text-gray-700">${penilaian.data_magang?.profil_peserta?.nama || 'N/A'}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">NIM:</h4>
                            <p class="text-gray-700">${penilaian.data_magang?.profil_peserta?.nim || 'N/A'}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Universitas:</h4>
                            <p class="text-gray-700">${penilaian.data_magang?.profil_peserta?.universitas || 'N/A'}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Jurusan:</h4>
                            <p class="text-gray-700">${penilaian.data_magang?.profil_peserta?.jurusan || 'N/A'}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Pembimbing:</h4>
                            <p class="text-gray-700">${penilaian.data_magang?.pembimbing?.name || 'Belum ditentukan'}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Nilai:</h4>
                            <p class="text-gray-700 text-xl font-bold">${parseFloat(penilaian.nilai).toFixed(2)}</p>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-900">Umpan Balik:</h4>
                            <p class="text-gray-700 whitespace-pre-wrap">${penilaian.umpan_balik || 'Tidak ada umpan balik'}</p>
                        </div>
                        ${penilaian.path_surat_nilai ? `
                            <div>
                                <h4 class="font-semibold text-gray-900">Surat Nilai:</h4>
                                <p class="text-blue-600">${penilaian.path_surat_nilai}</p>
                            </div>
                            ` : ''}
                        <div>
                            <h4 class="font-semibold text-gray-900">Tanggal Penilaian:</h4>
                            <p class="text-gray-700">${new Date(penilaian.created_at).toLocaleDateString('id-ID', { 
                                year: 'numeric', 
                                month: 'long', 
                                day: 'numeric' 
                            })}</p>
                        </div>
                    </div>
                `;
                document.getElementById('detailModal').classList.remove('hidden');
            }
        }

        function closeDetail() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('detailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDetail();
            }
        });
    </script>
</x-admin-layouts>
