<x-admin-layouts>
    <x-slot name="header">
        Edit Penilaian Akhir
    </x-slot>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <form action="{{ route('penilaian.update', [$magangId, $penilaian->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <x-input-label for="nilai" value="Nilai" />
                <x-text-input type="number" name="nilai" id="nilai" min="0" max="100" step="0.01" value="{{ $penilaian->nilai }}" class="w-full" required />
            </div>
            <div class="mb-4">
                <x-input-label for="umpan_balik" value="Umpan Balik" />
                <x-textarea name="umpan_balik" id="umpan_balik" class="w-full">{{ $penilaian->umpan_balik }}</x-textarea>
            </div>
            <div class="mb-4">
                <x-input-label for="path_surat_nilai" value="Path Surat Nilai" />
                <x-text-input type="text" name="path_surat_nilai" id="path_surat_nilai" value="{{ $penilaian->path_surat_nilai }}" class="w-full" />
            </div>
            <x-primary-button type="submit">Update</x-primary-button>
        </form>
    </div>
</x-admin-layouts>
