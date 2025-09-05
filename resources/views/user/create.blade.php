<x-admin-layouts>
    <x-slot name="header">
        Tambah User
    </x-slot>
    <div class="w-full md:w-7/12 xl:w-5/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <x-admin.form-input name="name" label="Nama" required="true" />
            <x-admin.form-input name="email" label="Email" type="email" required="true" />
            <x-admin.form-input name="password" label="Password" type="password" required="true" />
            <x-admin.form-select name="role" label="Role">
                <option value="magang">Magang</option>
                <option value="hr">HR</option>
                <option value="pembimbing">Pembimbing</option>
            </x-admin.form-select>
            <x-admin.form-button>Simpan</x-admin.form-button>
        </form>
    </div>
</x-admin-layouts>
