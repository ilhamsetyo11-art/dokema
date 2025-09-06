<x-admin-layouts>
    <x-slot name="header">
        Edit User
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <x-user.form :user="$user" :action="route('user.update', $user)" method="PUT" />
    </div>
</x-admin-layouts>
