<x-admin-layouts>
    <x-slot name="header">
        Profil Peserta
    </x-slot>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        @if (session('success'))
            <div class="mb-4 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
        @endif
        @if ($profil)
            <div class="space-y-2">
                <div><span class="font-semibold">NIM:</span> {{ $profil->nim }}</div>
                <div><span class="font-semibold">Universitas:</span> {{ $profil->universitas }}</div>
                <div><span class="font-semibold">Jurusan:</span> {{ $profil->jurusan }}</div>
                <div><span class="font-semibold">No Telepon:</span> {{ $profil->no_telepon }}</div>
                <div><span class="font-semibold">Alamat:</span> {{ $profil->alamat }}</div>
            </div>
            <a href="{{ route('profil.edit') }}" class="mt-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Edit
                Profil</a>
        @else
            <a href="{{ route('profil.create') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Lengkapi
                Profil</a>
        @endif
    </div>
</x-admin-layouts>
