<x-admin-layouts>
    <x-slot name="header">
        Edit Log Bimbingan
    </x-slot>
    <div class="w-full md:w-7/12 xl:w-5/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        <form action="{{ route('bimbingan.update', [$magangId, $log->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <x-admin.form-input name="waktu_bimbingan" label="Waktu Bimbingan" type="datetime-local" :value="$log->waktu_bimbingan" required="true" />
            <x-admin.form-textarea name="catatan_peserta" label="Catatan Peserta" :value="$log->catatan_peserta" />
            <x-admin.form-textarea name="catatan_pembimbing" label="Catatan Pembimbing" :value="$log->catatan_pembimbing" />
            <x-admin.form-button>Update</x-admin.form-button>
        </form>
    </div>
</x-admin-layouts>
