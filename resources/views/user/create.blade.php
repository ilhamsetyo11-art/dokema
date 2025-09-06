<x-admin-layouts>
    <x-slot name="header">
        Tambah User
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <x-user.form :action="route('user.store')" method="POST" />
    </div>
</x-admin-layouts>
