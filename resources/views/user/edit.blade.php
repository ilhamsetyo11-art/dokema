<x-admin-layouts>
    <x-slot name="header">
        Edit User
    </x-slot>
    <div class="w-full md:w-7/12 xl:w-5/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        <form action="{{ route('user.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <x-admin.form-input name="name" label="Nama" :value="$user->name" required="true" />
            <x-admin.form-input name="email" label="Email" type="email" :value="$user->email" required="true" />
            <x-admin.form-input name="password" label="Password (isi jika ingin ganti)" type="password" />
            <x-admin.form-select name="role" label="Role">
                <option value="magang" @if ($user->role == 'magang') selected @endif>Magang</option>
                <option value="hr" @if ($user->role == 'hr') selected @endif>HR</option>
                <option value="pembimbing" @if ($user->role == 'pembimbing') selected @endif>Pembimbing</option>
            </x-admin.form-select>
            <x-admin.form-button>Update</x-admin.form-button>
        </form>
    </div>
</x-admin-layouts>
