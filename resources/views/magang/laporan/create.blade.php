<x-admin-layouts>
    <x-slot name="header">
        Tambah Laporan Kegiatan
    </x-slot>

    <div class="max-w-4xl mx-auto">
        @include('magang.laporan.form', [
            'laporan' => null,
            'action' => route('laporan.store'),
            'method' => 'POST',
            'magangs' => $magangs,
        ])
    </div>
</x-admin-layouts>
