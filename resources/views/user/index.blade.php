<x-admin-layouts>
    <x-slot name="header">
        Manajemen User
    </x-slot>
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow">
        @if (session('success'))
            <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
        <div class="mb-6 flex justify-between items-center">
            <h3 class="text-xl font-medium">Daftar User</h3>
            <a href="{{ route('user.create') }}" class="px-4 py-2 bg-gray-800 text-gray-100 hover:bg-gray-900 rounded-md cursor-pointer">Tambah User</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-xs font-medium text-left text-gray-500 uppercase">Role</th>
                        <th class="px-6 py-3 text-xs font-medium text-center text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->role }}</td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('user.edit', $user) }}" class="text-gray-800 hover:text-gray-900 hover:bg-gray-100 flex items-center justify-center p-2 border border-gray-200 rounded-sm" title="Edit">
                                        <x-lucide-pencil class="w-5 h-5" />
                                    </a>
                                    <form action="{{ route('user.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-800 hover:text-gray-900 hover:bg-gray-100 cursor-pointer flex items-center justify-center p-2 border border-gray-200 rounded-sm" title="Hapus">
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
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layouts>
