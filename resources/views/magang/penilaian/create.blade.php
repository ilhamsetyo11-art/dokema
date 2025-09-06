<x-admin-layouts>
    <x-slot name="header">
        Buat Penilaian Akhir
    </x-slot>

    <div class="max-w-4xl mx-auto">
        @include('magang.penilaian.form', [
            'penilaian' => null,
            'action' => route('penilaian.store', $magangId),
            'method' => 'POST',
            'magangs' => $datamagangs ?? [],
        ])
    </div>
</x-admin-layouts>
