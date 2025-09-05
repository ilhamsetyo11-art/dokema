<x-admin-layouts>
    <x-slot name="header">
        Penilaian Akhir
    </x-slot>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        @if ($penilaian)
            <div class="space-y-2">
                <div><span class="font-semibold">Nilai:</span> {{ $penilaian->nilai }}</div>
                <div><span class="font-semibold">Umpan Balik:</span> {{ $penilaian->umpan_balik }}</div>
                <div><span class="font-semibold">Surat Nilai:</span> {{ $penilaian->path_surat_nilai }}</div>
            </div>
        @else
            <a href="{{ route('penilaian.create', $magangId) }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Buat Penilaian</a>
        @endif
    </div>
</x-admin-layouts>
