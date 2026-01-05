<x-admin-layouts>
    <x-slot name="header">
        Edit Penilaian Akhir
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Edit Penilaian Praktek Kerja Lapangan</h2>
                <p class="text-sm text-gray-600 mt-1">Dengan mempertimbangkan segala aspek, baik dari segi bobot pekerjaan maupun pelaksanaan Praktek Kerja Lapangan</p>
            </div>

            <form action="{{ route('penilaian.update', $penilaian->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6" x-data="penilaianForm({{ $penilaian->nilai_keputusan_pemberi }}, {{ $penilaian->nilai_disiplin }}, {{ $penilaian->nilai_prioritas }}, {{ $penilaian->nilai_tepat_waktu }}, {{ $penilaian->nilai_bekerja_sama }}, {{ $penilaian->nilai_bekerja_mandiri }}, {{ $penilaian->nilai_ketelitian }}, {{ $penilaian->nilai_belajar_menyerap }}, {{ $penilaian->nilai_analisa_merancang }})">
                @csrf
                @method('PUT')

                <!-- Info Peserta (Read-only) -->
                <div class="bg-blue-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-900 mb-4">Informasi Peserta</h4>

                    <input type="hidden" name="data_magang_id" value="{{ $penilaian->data_magang_id }}">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
                    </div>
                </div>

                <!-- Komponen Penilaian -->
                <div class="bg-green-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-900 mb-4">Materi Penilaian (Skala 0-100)</h4>

                    <div class="space-y-4">
                        <!-- 1. Keputusan Pemberi Praktek Kerja Lapangan -->
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <div class="col-span-1 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white text-sm font-medium">1</span>
                            </div>
                            <div class="col-span-8">
                                <label class="block text-sm font-medium text-gray-700">Keputusan Pemberi Praktek Kerja Lapangan</label>
                            </div>
                            <div class="col-span-3">
                                <input type="number" name="nilai_keputusan_pemberi" x-model.number="nilai1" @input="calculateTotal()" min="0" max="100" step="0.01" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="0-100" required>
                            </div>
                        </div>

                        <!-- 2. Disiplin -->
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <div class="col-span-1 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white text-sm font-medium">2</span>
                            </div>
                            <div class="col-span-8">
                                <label class="block text-sm font-medium text-gray-700">Disiplin</label>
                            </div>
                            <div class="col-span-3">
                                <input type="number" name="nilai_disiplin" x-model.number="nilai2" @input="calculateTotal()" min="0" max="100" step="0.01" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="0-100" required>
                            </div>
                        </div>

                        <!-- 3. Kemampuan memilih prioritas -->
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <div class="col-span-1 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white text-sm font-medium">3</span>
                            </div>
                            <div class="col-span-8">
                                <label class="block text-sm font-medium text-gray-700">Kemampuan memilih prioritas</label>
                            </div>
                            <div class="col-span-3">
                                <input type="number" name="nilai_prioritas" x-model.number="nilai3" @input="calculateTotal()" min="0" max="100" step="0.01" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="0-100" required>
                            </div>
                        </div>

                        <!-- 4. Tepat waktu -->
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <div class="col-span-1 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white text-sm font-medium">4</span>
                            </div>
                            <div class="col-span-8">
                                <label class="block text-sm font-medium text-gray-700">Tepat waktu</label>
                            </div>
                            <div class="col-span-3">
                                <input type="number" name="nilai_tepat_waktu" x-model.number="nilai4" @input="calculateTotal()" min="0" max="100" step="0.01" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="0-100" required>
                            </div>
                        </div>

                        <!-- 5. Kemampuan bekerja sama -->
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <div class="col-span-1 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white text-sm font-medium">5</span>
                            </div>
                            <div class="col-span-8">
                                <label class="block text-sm font-medium text-gray-700">Kemampuan bekerja sama</label>
                            </div>
                            <div class="col-span-3">
                                <input type="number" name="nilai_bekerja_sama" x-model.number="nilai5" @input="calculateTotal()" min="0" max="100" step="0.01" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="0-100" required>
                            </div>
                        </div>

                        <!-- 6. Kemampuan bekerja mandiri -->
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <div class="col-span-1 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white text-sm font-medium">6</span>
                            </div>
                            <div class="col-span-8">
                                <label class="block text-sm font-medium text-gray-700">Kemampuan bekerja mandiri</label>
                            </div>
                            <div class="col-span-3">
                                <input type="number" name="nilai_bekerja_mandiri" x-model.number="nilai6" @input="calculateTotal()" min="0" max="100" step="0.01" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="0-100" required>
                            </div>
                        </div>

                        <!-- 7. Ketelitian -->
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <div class="col-span-1 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white text-sm font-medium">7</span>
                            </div>
                            <div class="col-span-8">
                                <label class="block text-sm font-medium text-gray-700">Ketelitian</label>
                            </div>
                            <div class="col-span-3">
                                <input type="number" name="nilai_ketelitian" x-model.number="nilai7" @input="calculateTotal()" min="0" max="100" step="0.01" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="0-100" required>
                            </div>
                        </div>

                        <!-- 8. Kemampuan belajar dan kemampuan menyerap hal baru -->
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <div class="col-span-1 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white text-sm font-medium">8</span>
                            </div>
                            <div class="col-span-8">
                                <label class="block text-sm font-medium text-gray-700">Kemampuan belajar dan kemampuan menyerap hal baru</label>
                            </div>
                            <div class="col-span-3">
                                <input type="number" name="nilai_belajar_menyerap" x-model.number="nilai8" @input="calculateTotal()" min="0" max="100" step="0.01" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="0-100" required>
                            </div>
                        </div>

                        <!-- 9. Kemampuan analisa merancang -->
                        <div class="grid grid-cols-12 gap-4 items-center">
                            <div class="col-span-1 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-600 text-white text-sm font-medium">9</span>
                            </div>
                            <div class="col-span-8">
                                <label class="block text-sm font-medium text-gray-700">Kemampuan analisa merancang</label>
                            </div>
                            <div class="col-span-3">
                                <input type="number" name="nilai_analisa_merancang" x-model.number="nilai9" @input="calculateTotal()" min="0" max="100" step="0.01" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="0-100" required>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hasil Perhitungan -->
                <div class="bg-yellow-50 rounded-lg p-4 border-2 border-yellow-200">
                    <h4 class="text-sm font-medium text-gray-900 mb-4">Hasil Perhitungan</h4>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white rounded-lg p-4 border border-gray-200">
                            <div class="text-sm text-gray-600">Jumlah Nilai</div>
                            <div class="text-2xl font-bold text-gray-900" x-text="jumlah.toFixed(2)">0.00</div>
                        </div>
                        <div class="bg-white rounded-lg p-4 border border-gray-200">
                            <div class="text-sm text-gray-600">Rata-rata</div>
                            <div class="text-2xl font-bold text-blue-600" x-text="rataRata.toFixed(2)">0.00</div>
                        </div>
                        <div class="bg-white rounded-lg p-4 border border-gray-200">
                            <div class="text-sm text-gray-600">Konversi Nilai</div>
                            <div class="text-2xl font-bold text-green-600">
                                <span x-text="nilaiHuruf">-</span> (<span x-text="bobot.toFixed(1)">0.0</span>)
                            </div>
                            <div class="text-xs text-gray-600 mt-1" x-text="keterangan">-</div>
                        </div>
                    </div>
                </div>

                <!-- Umpan Balik -->
                <div class="bg-purple-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-900 mb-4">Umpan Balik (Opsional)</h4>
                    <x-admin.form-textarea name="umpan_balik" label="Catatan / Umpan Balik untuk Peserta" :value="old('umpan_balik', $penilaian->umpan_balik)" placeholder="Tuliskan catatan atau umpan balik mengenai kinerja peserta selama magang..." rows="4" required="false" />
                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <a href="{{ route('penilaian.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-300 text-gray-700 font-medium rounded-md hover:bg-gray-400 transition">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Penilaian
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function penilaianForm(val1 = 0, val2 = 0, val3 = 0, val4 = 0, val5 = 0, val6 = 0, val7 = 0, val8 = 0, val9 = 0) {
                return {
                    nilai1: val1,
                    nilai2: val2,
                    nilai3: val3,
                    nilai4: val4,
                    nilai5: val5,
                    nilai6: val6,
                    nilai7: val7,
                    nilai8: val8,
                    nilai9: val9,
                    jumlah: 0,
                    rataRata: 0,
                    nilaiHuruf: '-',
                    bobot: 0,
                    keterangan: '-',

                    init() {
                        this.calculateTotal();
                    },

                    calculateTotal() {
                        this.jumlah = this.nilai1 + this.nilai2 + this.nilai3 + this.nilai4 +
                            this.nilai5 + this.nilai6 + this.nilai7 + this.nilai8 + this.nilai9;
                        this.rataRata = this.jumlah / 9;
                        this.konversiNilai();
                    },

                    konversiNilai() {
                        const rata = this.rataRata;
                        if (rata >= 85) {
                            this.nilaiHuruf = 'A';
                            this.bobot = 4.0;
                            this.keterangan = 'Memuaskan';
                        } else if (rata >= 75) {
                            this.nilaiHuruf = 'AB';
                            this.bobot = 3.5;
                            this.keterangan = 'Sangat Baik';
                        } else if (rata >= 67) {
                            this.nilaiHuruf = 'B';
                            this.bobot = 3.0;
                            this.keterangan = 'Baik';
                        } else if (rata >= 61) {
                            this.nilaiHuruf = 'BC';
                            this.bobot = 2.5;
                            this.keterangan = 'Cukup Baik';
                        } else if (rata >= 55) {
                            this.nilaiHuruf = 'C';
                            this.bobot = 2.0;
                            this.keterangan = 'Sedang';
                        } else if (rata >= 45) {
                            this.nilaiHuruf = 'CD';
                            this.bobot = 1.5;
                            this.keterangan = 'Kurang';
                        } else if (rata >= 35) {
                            this.nilaiHuruf = 'D';
                            this.bobot = 1.0;
                            this.keterangan = 'Sangat Kurang';
                        } else {
                            this.nilaiHuruf = 'E';
                            this.bobot = 0.0;
                            this.keterangan = 'Gagal';
                        }
                    }
                }
            }
        </script>
    @endpush
</x-admin-layouts>
