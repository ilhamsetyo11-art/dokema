<x-admin-layouts>
    <x-slot name="header">
        Detail Penilaian Akhir
    </x-slot>

    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-medium text-gray-900">Detail Penilaian Praktek Kerja Lapangan</h2>
                    <div class="flex gap-2">
                        <a href="{{ route('penilaian.print', $penilaian->id) }}" target="_blank" class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                            </svg>
                            Print
                        </a>
                        <a href="{{ route('penilaian.index') }}" class="text-gray-600 hover:text-gray-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- Info Peserta -->
                <div class="bg-blue-50 rounded-lg p-6 border-2 border-blue-200">
                    <h3 class="text-sm font-medium text-gray-700 mb-4">Informasi Peserta Magang</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-600">Nama Peserta</p>
                            <p class="text-base font-medium text-gray-900">{{ $penilaian->dataMagang->profilPeserta->nama_peserta }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">NIM</p>
                            <p class="text-base font-medium text-gray-900">{{ $penilaian->dataMagang->profilPeserta->nim }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Universitas</p>
                            <p class="text-base font-medium text-gray-900">{{ $penilaian->dataMagang->profilPeserta->universitas }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Jurusan</p>
                            <p class="text-base font-medium text-gray-900">{{ $penilaian->dataMagang->profilPeserta->jurusan }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Pembimbing</p>
                            <p class="text-base font-medium text-gray-900">
                                {{ $penilaian->dataMagang->pembimbing ? $penilaian->dataMagang->pembimbing->name : '-' }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Periode Magang</p>
                            <p class="text-base font-medium text-gray-900">
                                {{ \Carbon\Carbon::parse($penilaian->dataMagang->tanggal_mulai)->format('d M Y') }} -
                                {{ \Carbon\Carbon::parse($penilaian->dataMagang->tanggal_selesai)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Komponen Penilaian -->
                <div class="bg-green-50 rounded-lg p-6 border-2 border-green-200">
                    <h3 class="text-sm font-medium text-gray-700 mb-4">Materi Penilaian</h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr class="bg-green-100">
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">No</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-700 uppercase">Materi Penilaian</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-700 uppercase">Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900">1</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Keputusan Pemberi Praktek Kerja Lapangan</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900 text-center">{{ number_format($penilaian->nilai_keputusan_pemberi, 2) }}</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900">2</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Disiplin</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900 text-center">{{ number_format($penilaian->nilai_disiplin, 2) }}</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900">3</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Kemampuan memilih prioritas</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900 text-center">{{ number_format($penilaian->nilai_prioritas, 2) }}</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900">4</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Tepat waktu</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900 text-center">{{ number_format($penilaian->nilai_tepat_waktu, 2) }}</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900">5</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Kemampuan bekerja sama</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900 text-center">{{ number_format($penilaian->nilai_bekerja_sama, 2) }}</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900">6</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Kemampuan bekerja mandiri</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900 text-center">{{ number_format($penilaian->nilai_bekerja_mandiri, 2) }}</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900">7</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Ketelitian</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900 text-center">{{ number_format($penilaian->nilai_ketelitian, 2) }}</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900">8</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Kemampuan belajar dan kemampuan menyerap hal baru</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900 text-center">{{ number_format($penilaian->nilai_belajar_menyerap, 2) }}</td>
                                </tr>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm text-gray-900">9</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">Kemampuan analisa merancang</td>
                                    <td class="px-4 py-3 text-sm font-medium text-gray-900 text-center">{{ number_format($penilaian->nilai_analisa_merancang, 2) }}</td>
                                </tr>
                                <tr class="bg-gray-100 font-medium">
                                    <td colspan="2" class="px-4 py-3 text-sm text-gray-900 text-right">Jumlah</td>
                                    <td class="px-4 py-3 text-sm font-bold text-gray-900 text-center">{{ number_format($penilaian->jumlah_nilai, 2) }}</td>
                                </tr>
                                <tr class="bg-gray-100 font-medium">
                                    <td colspan="2" class="px-4 py-3 text-sm text-gray-900 text-right">Rata-rata</td>
                                    <td class="px-4 py-3 text-sm font-bold text-blue-600 text-center">{{ number_format($penilaian->rata_rata, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Hasil Konversi -->
                <div class="bg-yellow-50 rounded-lg p-6 border-2 border-yellow-200">
                    <h3 class="text-sm font-medium text-gray-700 mb-4">Hasil Konversi Nilai</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white rounded-lg p-6 border-2 border-gray-300 text-center">
                            <div class="text-sm text-gray-600 mb-2">Nilai Huruf</div>
                            <div class="text-4xl font-bold text-green-600">{{ $penilaian->nilai_huruf }}</div>
                        </div>
                        <div class="bg-white rounded-lg p-6 border-2 border-gray-300 text-center">
                            <div class="text-sm text-gray-600 mb-2">Bobot</div>
                            <div class="text-4xl font-bold text-blue-600">{{ number_format($penilaian->bobot, 1) }}</div>
                        </div>
                        <div class="bg-white rounded-lg p-6 border-2 border-gray-300 text-center">
                            <div class="text-sm text-gray-600 mb-2">Keterangan</div>
                            <div class="text-2xl font-bold text-purple-600">{{ $penilaian->keterangan }}</div>
                        </div>
                    </div>
                </div>

                <!-- Umpan Balik -->
                @if ($penilaian->umpan_balik)
                    <div class="bg-purple-50 rounded-lg p-6 border-2 border-purple-200">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">Umpan Balik</h3>
                        <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $penilaian->umpan_balik }}</p>
                    </div>
                @endif

                <!-- Metadata -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-4">Informasi Penilaian</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Penilai</p>
                            <p class="text-base font-medium text-gray-900">{{ $penilaian->penilai ? $penilaian->penilai->name : '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Tanggal Penilaian</p>
                            <p class="text-base font-medium text-gray-900">
                                {{ $penilaian->tanggal_penilaian ? \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->format('d F Y') : '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-between pt-4 border-t">
                    <a href="{{ route('penilaian.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-medium rounded-md hover:bg-gray-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>

                    <a href="{{ route('penilaian.print', $penilaian->id) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Cetak Penilaian
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-admin-layouts>
