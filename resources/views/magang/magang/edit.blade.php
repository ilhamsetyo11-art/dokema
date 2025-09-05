<x-admin-layouts>
    <x-slot name="header">
        Edit Data Magang
    </x-slot>
    <div class="w-full md:w-7/12 xl:w-5/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        <form action="{{ route('magang.update', $magang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-admin.form-select name="profil_peserta_id" label="Peserta" required="true">
                <option value="">-- Pilih Peserta --</option>
                @foreach ($pesertas as $peserta)
                    <option value="{{ $peserta->id }}" {{ $magang->profil_peserta_id == $peserta->id ? 'selected' : '' }}>{{ $peserta->nim }} - {{ $peserta->universitas }}</option>
                @endforeach
            </x-admin.form-select>
            <x-admin.form-select name="pembimbing_id" label="Pembimbing">
                <option value="">-- Pilih Pembimbing --</option>
                @foreach ($pembimbings as $pembimbing)
                    <option value="{{ $pembimbing->id }}" {{ $magang->pembimbing_id == $pembimbing->id ? 'selected' : '' }}>{{ $pembimbing->name }} ({{ $pembimbing->email }})</option>
                @endforeach
            </x-admin.form-select>
            <div x-data="fileUploadComponentEdit('{{ asset('storage/' . $magang->path_surat_permohonan) }}', '{{ asset('storage/' . $magang->path_surat_balasan) }}')" class="mb-4">
                <label class="block font-semibold mb-2">Surat Permohonan (PDF/Gambar)</label>
                <div class="border-2 border-dashed rounded p-4 flex flex-col items-center justify-center cursor-pointer bg-gray-50" @dragover.prevent @drop.prevent="handleDrop($event, 'permohonan')" @click="$refs.permohonan.click()">
                    <input type="file" name="surat_permohonan" accept="application/pdf,image/*" class="hidden" x-ref="permohonan" @change="handleFileChange($event, 'permohonan')">
                    <template x-if="files.permohonan">
                        <div class="mb-2">
                            <template x-if="files.permohonan.type && files.permohonan.type.startsWith('image/')">
                                <img :src="files.permohonanUrl" class="max-h-40 mb-2" />
                            </template>
                            <template x-if="files.permohonan.type === 'application/pdf'">
                                <iframe :src="files.permohonanUrl" class="w-full h-40 mb-2" />
                            </template>
                            <div class="text-sm">{{ files . permohonan . name }}</div>
                        </div>
                    </template>
                    <template x-if="!files.permohonan && initialPermohonan">
                        <div class="mb-2">
                            <template x-if="initialPermohonan.endsWith('.pdf')">
                                <iframe :src="initialPermohonan" class="w-full h-40 mb-2" />
                            </template>
                            <template x-if="!initialPermohonan.endsWith('.pdf')">
                                <img :src="initialPermohonan" class="max-h-40 mb-2" />
                            </template>
                            <div class="text-sm">File sebelumnya</div>
                        </div>
                    </template>
                    <span x-show="!files.permohonan && !initialPermohonan" class="text-gray-500">Drag & drop file di sini atau klik untuk pilih file</span>
                </div>
            </div>
            <div x-data="fileUploadComponentEdit('', '{{ asset('storage/' . $magang->path_surat_balasan) }}')" class="mb-4">
                <label class="block font-semibold mb-2">Surat Balasan (PDF/Gambar)</label>
                <div class="border-2 border-dashed rounded p-4 flex flex-col items-center justify-center cursor-pointer bg-gray-50" @dragover.prevent @drop.prevent="handleDrop($event, 'balasan')" @click="$refs.balasan.click()">
                    <input type="file" name="surat_balasan" accept="application/pdf,image/*" class="hidden" x-ref="balasan" @change="handleFileChange($event, 'balasan')">
                    <template x-if="files.balasan">
                        <div class="mb-2">
                            <template x-if="files.balasan.type && files.balasan.type.startsWith('image/')">
                                <img :src="files.balasanUrl" class="max-h-40 mb-2" />
                            </template>
                            <template x-if="files.balasan.type === 'application/pdf'">
                                <iframe :src="files.balasanUrl" class="w-full h-40 mb-2" />
                            </template>
                            <div class="text-sm">{{ files . balasan . name }}</div>
                        </div>
                    </template>
                    <template x-if="!files.balasan && initialBalasan">
                        <div class="mb-2">
                            <template x-if="initialBalasan.endsWith('.pdf')">
                                <iframe :src="initialBalasan" class="w-full h-40 mb-2" />
                            </template>
                            <template x-if="!initialBalasan.endsWith('.pdf')">
                                <img :src="initialBalasan" class="max-h-40 mb-2" />
                            </template>
                            <div class="text-sm">File sebelumnya</div>
                        </div>
                    </template>
                    <span x-show="!files.balasan && !initialBalasan" class="text-gray-500">Drag & drop file di sini atau klik untuk pilih file</span>
                </div>
            </div>
            <x-admin.form-input name="tanggal_mulai" label="Tanggal Mulai" type="date" :value="$magang->tanggal_mulai" required="true" />
            <x-admin.form-input name="tanggal_selesai" label="Tanggal Selesai" type="date" :value="$magang->tanggal_selesai" required="true" />
            <x-admin.form-select name="status" label="Status">
                <option value="menunggu" {{ $magang->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diterima" {{ $magang->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ $magang->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </x-admin.form-select>
            <x-admin.form-button>Update</x-admin.form-button>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
        <script>
            function fileUploadComponentEdit(initialPermohonan, initialBalasan) {
                return {
                    files: {
                        permohonan: null,
                        balasan: null
                    },
                    filesUrl: {
                        permohonan: '',
                        balasan: ''
                    },
                    initialPermohonan: initialPermohonan,
                    initialBalasan: initialBalasan,
                    get permohonanUrl() {
                        return this.files.permohonan ? this.filesUrl.permohonan : this.initialPermohonan;
                    },
                    get balasanUrl() {
                        return this.files.balasan ? this.filesUrl.balasan : this.initialBalasan;
                    },
                    handleFileChange(e, type) {
                        const file = e.target.files[0];
                        if (file) {
                            this.files[type] = file;
                            this.filesUrl[type] = URL.createObjectURL(file);
                        }
                    },
                    handleDrop(e, type) {
                        const file = e.dataTransfer.files[0];
                        if (file) {
                            this.files[type] = file;
                            this.filesUrl[type] = URL.createObjectURL(file);
                        }
                    }
                }
            }
        </script>
    </div>
</x-admin-layouts>
