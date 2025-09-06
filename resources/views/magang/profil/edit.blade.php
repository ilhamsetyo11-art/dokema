<x-admin-layouts>
    <x-slot name="header">
        Edit Profil Peserta
    </x-slot>

    <div class="max-w-4xl mx-auto">
        @include('magang.profil.form', [
            'profil' => $profil,
            'action' => route('profil.update', ['id' => $profil->id]),
            'method' => 'PUT',
            'users' => $users,
        ])
    </div>
</x-admin-layouts>
