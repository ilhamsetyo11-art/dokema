<x-admin-layouts>
    <x-slot name="header">
        Tambah Log Bimbingan
    </x-slot>
    <div class="w-full md:w-7/12 xl:w-5/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        <form action="{{ route('bimbingan.store', $magangId) }}" method="POST">
            @csrf
            <x-admin.form-input name="waktu_bimbingan" label="Waktu Bimbingan" type="datetime-local" required="true" />
            <x-admin.form-textarea name="catatan_peserta" label="Catatan Peserta" />
            <x-admin.form-textarea name="catatan_pembimbing" label="Catatan Pembimbing" />
            <x-admin.form-button>Simpan</x-admin.form-button>
        </form>
    </div>
</x-admin-layouts>
