<x-admin-layouts>
    <x-slot name="header">
        Edit Laporan Kegiatan
    </x-slot>

    <div class="max-w-4xl mx-auto">
        @include('magang.laporan.form', [
            'laporan' => $laporan,
            'action' => route('laporan.update', $laporan->id),
            'method' => 'PUT',
            'magangs' => $magangs,
        ])
    </div>
</x-admin-layouts>
