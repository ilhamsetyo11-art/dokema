<x-admin-layouts>
    <x-slot name="header">
        Profil Peserta
    </x-slot>
    <div class="w-full md:w-11/12 xl:w-10/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        @if (session('success'))
            <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-2">
            <h2 class="text-lg font-semibold text-blue-900">Manajemen Profil Pemagang</h2>
            <a href="{{ route('profil.create') }}" class="px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">Tambah Profil</a>
        </div>
        <x-admin.table>
            <x-slot name="thead">
                <tr>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">NIM</th>
                    <th class="px-4 py-2 border">Universitas</th>
                    <th class="px-4 py-2 border">Jurusan</th>
                    <th class="px-4 py-2 border">No Telepon</th>
                    <th class="px-4 py-2 border">Alamat</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </x-slot>
            @forelse ($profils as $profil)
                <tr class="hover:bg-blue-50">
                    <td class="px-4 py-2 border">{{ $profil->user->name ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $profil->user->email ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $profil->nim }}</td>
                    <td class="px-4 py-2 border">{{ $profil->universitas }}</td>
                    <td class="px-4 py-2 border">{{ $profil->jurusan }}</td>
                    <td class="px-4 py-2 border">{{ $profil->no_telepon }}</td>
                    <td class="px-4 py-2 border">{{ $profil->alamat }}</td>
                    <td class="px-4 py-2 border">
                        <a href="{{ route('profil.edit', ['id' => $profil->id]) }}" class="px-3 py-1 bg-blue-900 text-white rounded hover:bg-blue-800">Edit</a>
                        <form action="{{ route('profil.destroy', ['id' => $profil->id]) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus profil?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 ml-2">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-4">Belum ada data profil pemagang.</td>
                </tr>
            @endforelse
        </x-admin.table>
    </div>
</x-admin-layouts>
