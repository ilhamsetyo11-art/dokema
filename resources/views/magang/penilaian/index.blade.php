<x-admin-layouts>
    <x-slot name="header">
        Penilaian Akhir
    </x-slot>
    <div class="w-full md:w-11/12 xl:w-8/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        @if ($penilaian)
            <div class="space-y-2">
                <div class="flex flex-col md:flex-row md:items-center md:gap-4">
                    <span class="font-semibold text-blue-900">Nilai:</span> <span class="text-lg">{{ $penilaian->nilai }}</span>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:gap-4">
                    <span class="font-semibold text-blue-900">Umpan Balik:</span> <span>{{ $penilaian->umpan_balik }}</span>
                </div>
                <div class="flex flex-col md:flex-row md:items-center md:gap-4">
                    <span class="font-semibold text-blue-900">Surat Nilai:</span> <span>{{ $penilaian->path_surat_nilai }}</span>
                </div>
            </div>
        @else
            <a href="{{ route('penilaian.create', $magangId) }}" class="px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">Buat Penilaian</a>
        @endif
    </div>
</x-admin-layouts>
