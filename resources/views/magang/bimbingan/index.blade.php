<x-admin-layouts>
    <x-slot name="header">
        Log Bimbingan
    </x-slot>
    <div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <a href="{{ route('bimbingan.create', $magangId) }}" class="mb-4 inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Tambah Log Bimbingan</a>
        <table class="w-full border mt-4">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Waktu Bimbingan</th>
                    <th class="p-2 border">Catatan Peserta</th>
                    <th class="p-2 border">Catatan Pembimbing</th>
                </tr>
            </thead>
            <tbody>
                @forelse($log as $l)
                    <tr>
                        <td class="p-2 border">{{ $l->waktu_bimbingan }}</td>
                        <td class="p-2 border">{{ $l->catatan_peserta }}</td>
                        <td class="p-2 border">{{ $l->catatan_pembimbing }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-2 border text-center text-gray-500">Belum ada log bimbingan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layouts>
