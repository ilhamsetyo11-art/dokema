<x-admin-layouts>
    <x-slot name="header">
        Edit Penilaian Akhir
    </x-slot>

    <div class="max-w-4xl mx-auto">
        @include('magang.penilaian.form', [
            'penilaian' => $penilaian,
            'action' => route('penilaian.update', [$magangId, $penilaian->id]),
            'method' => 'PUT',
            'magangs' => $datamagangs ?? [],
        ])
    </div>
</x-admin-layouts>
