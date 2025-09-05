<x-admin-layouts>
    <x-slot name="header">
        Tambah User
    </x-slot>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-input-label for="name" value="Nama" />
                <x-text-input type="text" name="name" id="name" class="w-full" required />
            </div>
            <div class="mb-4">
                <x-input-label for="email" value="Email" />
                <x-text-input type="email" name="email" id="email" class="w-full" required />
            </div>
            <div class="mb-4">
                <x-input-label for="password" value="Password" />
                <x-text-input type="password" name="password" id="password" class="w-full" required />
            </div>
            <div class="mb-4">
                <x-input-label for="role" value="Role" />
                <select name="role" id="role" class="w-full border rounded px-3 py-2">
                    <option value="magang">Magang</option>
                    <option value="hr">HR</option>
                    <option value="pembimbing">Pembimbing</option>
                </select>
            </div>
            <x-primary-button type="submit">Simpan</x-primary-button>
        </form>
    </div>
</x-admin-layouts>
