    <x-admin-layouts>
        <x-slot name="header">
            Edit Profil Peserta
        </x-slot>
        <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
            <form action="{{ route('profil.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <x-input-label for="nim" value="NIM" />
                    <x-text-input type="text" name="nim" id="nim" value="{{ $profil->nim }}" class="w-full" required />
                </div>
                <div class="mb-4">
                    <x-input-label for="universitas" value="Universitas" />
                    <x-text-input type="text" name="universitas" id="universitas" value="{{ $profil->universitas }}" class="w-full" required />
                </div>
                <div class="mb-4">
                    <x-input-label for="jurusan" value="Jurusan" />
                    <x-text-input type="text" name="jurusan" id="jurusan" value="{{ $profil->jurusan }}" class="w-full" required />
                </div>
                <div class="mb-4">
                    <x-input-label for="no_telepon" value="No Telepon" />
                    <x-text-input type="text" name="no_telepon" id="no_telepon" value="{{ $profil->no_telepon }}" class="w-full" required />
                </div>
                <div class="mb-4">
                    <x-input-label for="alamat" value="Alamat" />
                    <x-textarea name="alamat" id="alamat" class="w-full">{{ $profil->alamat }}</x-textarea>
                </div>
                <x-primary-button type="submit">Update</x-primary-button>
            </form>
        </div>
    </x-admin-layouts>
