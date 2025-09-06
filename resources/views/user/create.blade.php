<x-admin-layouts>
    <x-slot name="header">
        Tambah User
    </x-slot>

    <div class="max-w-4xl mx-auto">
        @include('user.form', [
            'user' => null,
            'action' => route('user.store'),
            'method' => 'POST',
        ])
    </div>
</x-admin-layouts>
