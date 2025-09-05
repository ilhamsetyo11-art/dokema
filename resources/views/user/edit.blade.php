<x-admin-layouts>
    <x-slot name="header">
        Edit User
    </x-slot>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <form action="{{ route('user.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <x-input-label for="name" value="Nama" />
                <x-text-input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full" required />
            </div>
            <div class="mb-4">
                <x-input-label for="email" value="Email" />
                <x-text-input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full" required />
            </div>
            <div class="mb-4">
                <x-input-label for="password" value="Password (isi jika ingin ganti)" />
                <x-text-input type="password" name="password" id="password" class="w-full" />
            </div>
            <div class="mb-4">
                <x-input-label for="role" value="Role" />
                <select name="role" id="role" class="w-full border rounded px-3 py-2">
                    <option value="magang" @if ($user->role == 'magang') selected @endif>Magang</option>
                    <option value="hr" @if ($user->role == 'hr') selected @endif>HR</option>
                    <option value="pembimbing" @if ($user->role == 'pembimbing') selected @endif>Pembimbing</option>
                </select>
            </div>
            <x-primary-button type="submit">Update</x-primary-button>
        </form>
    </div>
</x-admin-layouts>
