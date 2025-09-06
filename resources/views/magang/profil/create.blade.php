<x-admin-layouts>
    <x-slot name="header">
        Tambah Profil Peserta
    </x-slot>

    <div class="max-w-4xl mx-auto">
        @include('magang.profil.form', [
            'profil' => null,
            'action' => route('profil.store'),
            'method' => 'POST',
            'users' => $users,
        ])
    </div>
</x-admin-layouts>
