<x-admin-layouts>
    <x-slot name="header">
        Tambah Data Magang
    </x-slot>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <form action="{{ route('magang.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-input-label for="path_surat_permohonan" value="Path Surat Permohonan" />
                <x-text-input type="text" name="path_surat_permohonan" id="path_surat_permohonan" class="w-full" required />
            </div>
            <div class="mb-4">
                <x-input-label for="tanggal_mulai" value="Tanggal Mulai" />
                <x-text-input type="date" name="tanggal_mulai" id="tanggal_mulai" class="w-full" required />
            </div>
            <div class="mb-4">
                <x-input-label for="tanggal_selesai" value="Tanggal Selesai" />
                <x-text-input type="date" name="tanggal_selesai" id="tanggal_selesai" class="w-full" required />
            </div>
            <x-primary-button type="submit">Simpan</x-primary-button>
        </form>
    </div>
</x-admin-layouts>
