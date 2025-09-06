@props(['user' => null, 'action', 'method' => 'POST'])

<div class="bg-white rounded-lg shadow">
    <form action="{{ $action }}" method="POST" class="space-y-6">
        @csrf
        @if ($method === 'PUT')
            @method('PUT')
        @endif

        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                {{ $user ? 'Edit User' : 'Tambah User Baru' }}
            </h3>
            <p class="mt-1 text-sm text-gray-600">
                {{ $user ? 'Perbarui informasi user' : 'Lengkapi formulir untuk menambah user baru' }}
            </p>
        </div>

        <div class="px-6 py-4 space-y-6">
            <!-- Name Field -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <x-admin.form-input name="name" label="Nama Lengkap" type="text" :value="old('name', $user->name ?? '')" required="true" placeholder="Masukkan nama lengkap" />
                </div>
            </div>

            <!-- Email Field -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <x-admin.form-input name="email" label="Alamat Email" type="email" :value="old('email', $user->email ?? '')" required="true" placeholder="user@example.com" />
                </div>
            </div>

            <!-- Role Field -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-admin.form-select name="role" label="Role User" required="true" placeholder="Pilih role user">
                        <option value="magang" {{ old('role', $user->role ?? '') === 'magang' ? 'selected' : '' }}>
                            Magang
                        </option>
                        <option value="hr" {{ old('role', $user->role ?? '') === 'hr' ? 'selected' : '' }}>
                            HR
                        </option>
                        <option value="pembimbing" {{ old('role', $user->role ?? '') === 'pembimbing' ? 'selected' : '' }}>
                            Pembimbing
                        </option>
                    </x-admin.form-select>
                </div>

                <!-- Password Field -->
                <div>
                    <x-admin.form-input name="password" label="{{ $user ? 'Password Baru (kosongkan jika tidak diubah)' : 'Password' }}" type="password" :required="$user ? 'false' : 'true'" placeholder="Minimal 8 karakter" />
                </div>
            </div>

            @if ($user)
                <!-- Status Information -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Informasi User</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Dibuat:</span>
                            <span class="font-medium">{{ $user->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Terakhir update:</span>
                            <span class="font-medium">{{ $user->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3">
            <a href="{{ route('user.index') }}" class="inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Batal
            </a>
            <button type="submit" class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ $user ? 'Update User' : 'Simpan User' }}
            </button>
        </div>
    </form>
</div>
