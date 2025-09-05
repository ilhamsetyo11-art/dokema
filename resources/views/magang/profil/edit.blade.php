<x-admin-layouts>
    <x-slot name="header">
        Edit Profil Peserta
    </x-slot>
    <div class="w-full md:w-7/12 xl:w-5/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        <form action="{{ route('profil.update', ['id' => $profil->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <x-admin.form-select name="user_id" label="User" required="true">
                <option value="">-- Pilih User --</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $profil->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </x-admin.form-select>
            <x-admin.form-input name="nim" label="NIM" :value="$profil->nim" required="true" />
            <x-admin.form-input name="universitas" label="Universitas" :value="$profil->universitas" required="true" />
            <x-admin.form-input name="jurusan" label="Jurusan" :value="$profil->jurusan" required="true" />
            <x-admin.form-input name="no_telepon" label="No Telepon" :value="$profil->no_telepon" required="true" />
            <x-admin.form-textarea name="alamat" label="Alamat" :value="$profil->alamat" />
            <x-admin.form-button>Update</x-admin.form-button>
        </form>
    </div>
</x-admin-layouts>
