<x-admin-layouts>
    <x-slot name="header">
        Data Magang
    </x-slot>
    <div class="w-full md:w-11/12 xl:w-10/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        @if (session('success'))
            <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-2">
            <h2 class="text-lg font-semibold text-blue-900">Data Magang</h2>
            <a href="{{ route('magang.create') }}" class="px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">Tambah Data Magang</a>
        </div>
        <x-admin.table>
            <x-slot name="thead">
                <tr>
                    <th class="px-4 py-2 border">Surat Permohonan</th>
                    <th class="px-4 py-2 border">Surat Balasan</th>
                    <th class="px-4 py-2 border">Tanggal Mulai</th>
                    <th class="px-4 py-2 border">Tanggal Selesai</th>
                    <th class="px-4 py-2 border">Status</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </x-slot>
            @forelse($magang as $m)
                <tr class="hover:bg-blue-50">
                    <td class="px-4 py-2 border">
                        @if ($m->path_surat_permohonan)
                            <a href="{{ asset('storage/' . $m->path_surat_permohonan) }}" target="_blank" class="text-blue-700 underline">Lihat Surat</a>
                            @if (Str::endsWith($m->path_surat_permohonan, ['.jpg', '.jpeg', '.png']))
                                <img src="{{ asset('storage/' . $m->path_surat_permohonan) }}" class="max-h-20 mt-2" />
                            @elseif(Str::endsWith($m->path_surat_permohonan, '.pdf'))
                                <iframe src="{{ asset('storage/' . $m->path_surat_permohonan) }}" class="w-full h-20 mt-2"></iframe>
                            @endif
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border">
                        @if ($m->path_surat_balasan)
                            <a href="{{ asset('storage/' . $m->path_surat_balasan) }}" target="_blank" class="text-blue-700 underline">Lihat Surat</a>
                            @if (Str::endsWith($m->path_surat_balasan, ['.jpg', '.jpeg', '.png']))
                                <img src="{{ asset('storage/' . $m->path_surat_balasan) }}" class="max-h-20 mt-2" />
                            @elseif(Str::endsWith($m->path_surat_balasan, '.pdf'))
                                <iframe src="{{ asset('storage/' . $m->path_surat_balasan) }}" class="w-full h-20 mt-2"></iframe>
                            @endif
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border">{{ $m->tanggal_mulai }}</td>
                    <td class="px-4 py-2 border">{{ $m->tanggal_selesai }}</td>
                    <td class="px-4 py-2 border">{{ ucfirst($m->status) }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('laporan.index', $m->id) }}" class="px-2 py-1 bg-blue-900 text-white rounded">Laporan</a>
                        <a href="{{ route('bimbingan.index', $m->id) }}" class="px-2 py-1 bg-yellow-600 text-white rounded">Bimbingan</a>
                        <a href="{{ route('penilaian.index', $m->id) }}" class="px-2 py-1 bg-green-700 text-white rounded">Penilaian</a>
                        <a href="{{ route('magang.edit', $m->id) }}" class="px-2 py-1 bg-blue-800 text-white rounded">Edit</a>
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
        </x-admin.table>
    </div>
</x-admin-layouts>
