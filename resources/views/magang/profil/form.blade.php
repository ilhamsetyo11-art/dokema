@props(['profil' => null, 'action', 'method' => 'POST', 'users' => []])

<div class="bg-white rounded-lg shadow">
    <form action="{{ $action }}" method="POST" class="space-y-6">
        @csrf
        @if ($method === 'PUT')
            @method('PUT')
        @endif

        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">
                {{ $profil ? 'Edit Profil Peserta' : 'Tambah Profil Peserta Baru' }}
            </h3>
            <p class="mt-1 text-sm text-gray-600">
                {{ $profil ? 'Perbarui informasi profil peserta' : 'Lengkapi formulir untuk menambah profil peserta baru' }}
            </p>
        </div>

        <div class="px-6 py-4 space-y-6">
            <!-- User Selection -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <x-admin.form-select name="user_id" label="Pilih User" required="true" placeholder="Pilih user untuk profil ini">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $profil->user_id ?? '') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </x-admin.form-select>
                </div>
            </div>

            <!-- Personal Info -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Informasi Personal</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-admin.form-input name="nim" label="NIM" type="text" :value="old('nim', $profil->nim ?? '')" required="true" placeholder="Nomor Induk Mahasiswa" />

                    <x-admin.form-input name="no_telepon" label="No. Telepon" type="tel" :value="old('no_telepon', $profil->no_telepon ?? '')" required="true" placeholder="08xxxxxxxxxx" />
                </div>
            </div>

            <!-- Academic Info -->
            <div class="bg-blue-50 rounded-lg p-4">
                <h4 class="text-sm font-medium text-gray-900 mb-4">Informasi Akademik</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-admin.form-input name="universitas" label="Universitas" type="text" :value="old('universitas', $profil->universitas ?? '')" required="true" placeholder="Nama universitas" />

                    <x-admin.form-input name="jurusan" label="Jurusan/Program Studi" type="text" :value="old('jurusan', $profil->jurusan ?? '')" required="true" placeholder="Nama jurusan atau program studi" />
                    <x-admin.form-input name="tambahan" label="tambahan/Program Studi" type="text" :value="old('tambahan', $profil->tambahan ?? '')" required="true" placeholder="Nama tambahan atau program studi" />
                </div>
            </div>

            <!-- Address -->
            <div>
                <x-admin.form-textarea name="alamat" label="Alamat Lengkap" :value="old('alamat', $profil->alamat ?? '')" required="true" placeholder="Masukkan alamat lengkap" :rows="3" />
            </div>

            @if ($profil)
                <!-- Status Information -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Informasi Profil</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Dibuat:</span>
                            <span class="font-medium">{{ $profil->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Terakhir update:</span>
                            <span class="font-medium">{{ $profil->updated_at->format('d M Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex flex-col sm:flex-row sm:justify-end space-y-3 sm:space-y-0 sm:space-x-3">
            <a href="{{ route('profil.index') }}" class="inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Batal
            </a>
            <button type="submit" class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ $profil ? 'Update Profil' : 'Simpan Profil' }}
            </button>
        </div>
    </form>
</div>
