<x-admin-layouts>
    <x-slot name="header">
        Tambah Data Magang
    </x-slot>

    <div class="max-w-4xl mx-auto">
        @include('magang.magang.form', [
            'magang' => null,
            'action' => route('magang.store'),
            'method' => 'POST',
            'profils' => $pesertas,
        ])
    </div>
</x-admin-layouts>
