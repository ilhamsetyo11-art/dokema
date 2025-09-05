<x-admin-layouts>
    <x-slot name="header">
        Tambah Data Magang
    </x-slot>
    <div class="w-full md:w-7/12 xl:w-5/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script>
            function fileUploadPermohonan() {
                return {
                    file: null,
                    fileUrl: '',
                    handleFileChange(e) {
                        const file = e.target.files[0];
                        if (file) {
                            this.file = file;
                            this.fileUrl = URL.createObjectURL(file);
                        }
                    },
                    handleDrop(e) {
                        const file = e.dataTransfer.files[0];
                        if (file) {
                            this.file = file;
                            this.fileUrl = URL.createObjectURL(file);
                        }
                    }
                }
            }

            function fileUploadBalasan() {
                return {
                    file: null,
                    fileUrl: '',
                    handleFileChange(e) {
                        const file = e.target.files[0];
                        if (file) {
                            this.file = file;
                            this.fileUrl = URL.createObjectURL(file);
                        }
                    },
                    handleDrop(e) {
                        const file = e.dataTransfer.files[0];
                        if (file) {
                            this.file = file;
                            this.fileUrl = URL.createObjectURL(file);
                        }
                    }
                }
            }
        </script>
        <form action="{{ route('magang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-admin.form-select name="profil_peserta_id" label="Peserta" required="true">
                <option value="">-- Pilih Peserta --</option>
                @foreach ($pesertas as $peserta)
                    <option value="{{ $peserta->id }}">{{ $peserta->nim }} - {{ $peserta->universitas }}</option>
                @endforeach
            </x-admin.form-select>
            <x-admin.form-select name="pembimbing_id" label="Pembimbing">
                <option value="">-- Pilih Pembimbing --</option>
                @foreach ($pembimbings as $pembimbing)
                    <option value="{{ $pembimbing->id }}">{{ $pembimbing->name }} ({{ $pembimbing->email }})</option>
                @endforeach
            </x-admin.form-select>
            <div x-data="fileUploadPermohonan()" class="mb-4">
                <label class="block font-semibold mb-2">Surat Permohonan (PDF/Gambar)</label>
                <div class="border-2 border-dashed border-gray-400 rounded p-6 flex flex-col items-center justify-center cursor-pointer bg-gray-50 hover:bg-gray-100 transition" @dragover.prevent @drop.prevent="handleDrop($event)" @click="$refs.permohonan.click()">
                    <input type="file" name="surat_permohonan" accept="application/pdf,image/*" class="hidden" x-ref="permohonan" @change="handleFileChange($event)">
                    <template x-if="file">
                        <div class="mb-2 w-full flex flex-col items-center">
                            <template x-if="file.type && file.type.startsWith('image/')">
                                <img :src="fileUrl" class="max-h-40 mb-2 rounded shadow" />
                            </template>
                            <template x-if="file.type === 'application/pdf'">
                                <iframe :src="fileUrl" class="w-full h-40 mb-2 border rounded"></iframe>
                            </template>
                            <div class="text-sm font-medium text-blue-700" x-text="file.name"></div>
                        </div>
                    </template>
                    <template x-if="!file">
                        <div class="flex flex-col items-center justify-center text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12m-4 4h-4a1 1 0 01-1-1v-4m5 5l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            <span class="font-semibold">Klik atau drag file ke sini</span>
                            <span class="text-xs">Format: PDF, JPG, PNG</span>
                        </div>
                    </template>
                </div>
            </div>
            <div x-data="fileUploadBalasan()" class="mb-4">
                <label class="block font-semibold mb-2">Surat Balasan (PDF/Gambar)</label>
                <div class="border-2 border-dashed border-gray-400 rounded p-6 flex flex-col items-center justify-center cursor-pointer bg-gray-50 hover:bg-gray-100 transition" @dragover.prevent @drop.prevent="handleDrop($event)" @click="$refs.balasan.click()">
                    <input type="file" name="surat_balasan" accept="application/pdf,image/*" class="hidden" x-ref="balasan" @change="handleFileChange($event)">
                    <template x-if="file">
                        <div class="mb-2 w-full flex flex-col items-center">
                            <template x-if="file.type && file.type.startsWith('image/')">
                                <img :src="fileUrl" class="max-h-40 mb-2 rounded shadow" />
                            </template>
                            <template x-if="file.type === 'application/pdf'">
                                <iframe :src="fileUrl" class="w-full h-40 mb-2 border rounded"></iframe>
                            </template>
                            <div class="text-sm font-medium text-blue-700" x-text="file.name"></div>
                        </div>
                    </template>
                    <template x-if="!file">
                        <div class="flex flex-col items-center justify-center text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4a1 1 0 011-1h8a1 1 0 011 1v12m-4 4h-4a1 1 0 01-1-1v-4m5 5l-5-5m0 0l5-5m-5 5h12" />
                            </svg>
                            <span class="font-semibold">Klik atau drag file ke sini</span>
                            <span class="text-xs">Format: PDF, JPG, PNG</span>
                        </div>
                    </template>
                </div>
            </div>
            <x-admin.form-input name="tanggal_mulai" label="Tanggal Mulai" type="date" required="true" />
            <x-admin.form-input name="tanggal_selesai" label="Tanggal Selesai" type="date" required="true" />
            <x-admin.form-select name="status" label="Status">
                <option value="menunggu">Menunggu</option>
                <option value="diterima">Diterima</option>
                <option value="ditolak">Ditolak</option>
            </x-admin.form-select>
            <div class="flex gap-2 mt-4">
                <x-admin.form-button>Simpan</x-admin.form-button>
                <a href="{{ route('magang.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">Cancel</a>
            </div>
        </form>
    </div>
</x-admin-layouts>
