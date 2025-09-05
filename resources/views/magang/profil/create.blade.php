<x-admin-layouts>
    <x-slot name="header">
        Buat Profil Peserta
    </x-slot>
    <div class="w-full md:w-7/12 xl:w-5/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        <form action="{{ route('profil.store') }}" method="POST">
            @csrf
            <x-admin.form-select name="user_id" label="User" required="true">
                <option value="">-- Pilih User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </x-admin.form-select>
            <x-admin.form-input name="nim" label="NIM" required="true" />
            <x-admin.form-input name="universitas" label="Universitas" required="true" />
            <x-admin.form-input name="jurusan" label="Jurusan" required="true" />
            <x-admin.form-input name="no_telepon" label="No Telepon" required="true" />
            <x-admin.form-textarea name="alamat" label="Alamat" />
            <x-admin.form-button>Simpan</x-admin.form-button>
        </form>
    </div>
</x-admin-layouts>
