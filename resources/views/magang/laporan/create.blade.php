<x-admin-layouts>
    <x-slot name="header">
        Tambah Laporan Kegiatan
    </x-slot>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <form action="{{ route('laporan.store', $magangId) }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-input-label for="tanggal_laporan" value="Tanggal Laporan" />
                <x-text-input type="date" name="tanggal_laporan" id="tanggal_laporan" class="w-full" required />
            </div>
            <div class="mb-4">
                <x-input-label for="deskripsi" value="Deskripsi" />
                <x-textarea name="deskripsi" id="deskripsi" class="w-full" required />
            </div>
            <div class="mb-4">
                <x-input-label for="path_lampiran" value="Path Lampiran" />
                <x-text-input type="text" name="path_lampiran" id="path_lampiran" class="w-full" />
            </div>
            <x-primary-button type="submit">Simpan</x-primary-button>
        </form>
    </div>
</x-admin-layouts>
