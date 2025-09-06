<x-admin-layouts>
    <x-slot name="header">
        Edit Data Magang
    </x-slot>

    <div class="max-w-4xl mx-auto">
        @include('magang.magang.form', [
            'magang' => $magang,
            'action' => route('magang.update', $magang->id),
            'method' => 'PUT',
            'profils' => $pesertas,
        ])
    </div>
</x-admin-layouts>
