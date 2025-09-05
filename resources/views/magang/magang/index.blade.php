<x-admin-layouts>
    <x-slot name="header">
        Data Magang
    </x-slot>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow">
        @if (session('success'))
            <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
        <a href="{{ route('magang.create') }}" class="mb-4 inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Tambah Data
            Magang</a>
        <table class="w-full border mt-4">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Surat Permohonan</th>
                    <th class="p-2 border">Tanggal Mulai</th>
                    <th class="p-2 border">Tanggal Selesai</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($magang as $m)
                    <tr>
                        <td class="p-2 border">{{ $m->path_surat_permohonan }}</td>
                        <td class="p-2 border">{{ $m->tanggal_mulai }}</td>
                        <td class="p-2 border">{{ $m->tanggal_selesai }}</td>
                        <td class="p-2 border">{{ ucfirst($m->status) }}</td>
                        <td class="p-2 border">
                            <a href="{{ route('laporan.index', $m->id) }}" class="px-2 py-1 bg-blue-500 text-white rounded">Laporan</a>
                            <a href="{{ route('bimbingan.index', $m->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Bimbingan</a>
                            <a href="{{ route('penilaian.index', $m->id) }}" class="px-2 py-1 bg-green-500 text-white rounded">Penilaian</a>
                            <a href="{{ route('magang.edit', $m->id) }}" class="px-2 py-1 bg-gray-500 text-white rounded">Edit</a>
                            <form action="{{ route('magang.destroy', $m->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus data magang ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 bg-red-600 text-white rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-2 border text-center text-gray-500">Belum ada data magang</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layouts>
