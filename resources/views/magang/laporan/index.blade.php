<x-admin-layouts>
    <x-slot name="header">
        Laporan Kegiatan
    </x-slot>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <a href="{{ route('laporan.create', $magangId) }}" class="mb-4 inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Tambah Laporan</a>
        <table class="w-full border mt-4">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Tanggal</th>
                    <th class="p-2 border">Deskripsi</th>
                    <th class="p-2 border">Lampiran</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporan as $l)
                    <tr>
                        <td class="p-2 border">{{ $l->tanggal_laporan }}</td>
                        <td class="p-2 border">{{ $l->deskripsi }}</td>
                        <td class="p-2 border">{{ $l->path_lampiran }}</td>
                        <td class="p-2 border">{{ ucfirst($l->status_verifikasi) }}</td>
                        <td class="p-2 border">{{ $l->catatan_verifikasi }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-2 border text-center text-gray-500">Belum ada laporan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layouts>

</html>
