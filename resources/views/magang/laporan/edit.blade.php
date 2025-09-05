<x-admin-layouts>
    <x-slot name="header">
        Edit Laporan Kegiatan
    </x-slot>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <form action="{{ route('laporan.update', [$magangId, $laporan->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <x-input-label for="tanggal_laporan" value="Tanggal Laporan" />
                <x-text-input type="date" name="tanggal_laporan" id="tanggal_laporan" value="{{ $laporan->tanggal_laporan }}" class="w-full" required />
            </div>
            <div class="mb-4">
                <x-input-label for="deskripsi" value="Deskripsi" />
                <x-textarea name="deskripsi" id="deskripsi" class="w-full" required>{{ $laporan->deskripsi }}</x-textarea>
            </div>
            <div class="mb-4">
                <x-input-label for="path_lampiran" value="Path Lampiran" />
                <x-text-input type="text" name="path_lampiran" id="path_lampiran" value="{{ $laporan->path_lampiran }}" class="w-full" />
            </div>
            <x-primary-button type="submit">Update</x-primary-button>
        </form>
    </div>
</x-admin-layouts>
