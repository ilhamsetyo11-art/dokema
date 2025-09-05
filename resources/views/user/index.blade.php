<x-admin-layouts>
    <x-slot name="header">
        Manajemen User
    </x-slot>
    <div class="w-full md:w-11/12 xl:w-10/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        @if (session('success'))
            <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
        <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-2">
            <h2 class="text-lg font-semibold text-blue-900">Daftar User</h2>
            <a href="{{ route('user.create') }}" class="px-4 py-2 bg-blue-900 text-white rounded hover:bg-blue-800">Tambah User</a>
        </div>
        <x-admin.table>
            <x-slot name="thead">
                <tr>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Email</th>
                    <th class="px-4 py-2 border">Role</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </x-slot>
            @forelse ($users as $user)
                <tr class="hover:bg-blue-50">
                    <td class="px-4 py-2 border">{{ $user->name }}</td>
                    <td class="px-4 py-2 border">{{ $user->email }}</td>
                    <td class="px-4 py-2 border">{{ $user->role }}</td>
                    <td class="px-4 py-2 border">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('user.edit', $user) }}" class="text-blue-900 hover:text-blue-800 hover:bg-blue-50 flex items-center justify-center p-2 border border-blue-200 rounded-sm" title="Edit">
                                <x-lucide-pencil class="w-5 h-5" />
                            </a>
                            <form action="{{ route('user.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-blue-900 hover:text-blue-800 hover:bg-blue-50 cursor-pointer flex items-center justify-center p-2 border border-blue-200 rounded-sm" title="Hapus">
                                    <x-lucide-trash-2 class="w-5 h-5" />
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada data user.</td>
                </tr>
            @endforelse
        </x-admin.table>
    </div>
</x-admin-layouts>
