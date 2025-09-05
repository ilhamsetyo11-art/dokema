<x-admin-layouts>
    <x-slot name="header">
        Tambah Laporan Kegiatan
    </x-slot>
    <div class="w-full md:w-7/12 xl:w-5/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        <form action="{{ route('laporan.store', $magangId) }}" method="POST">
            @csrf
            <x-admin.form-input name="tanggal_laporan" label="Tanggal Laporan" type="date" required="true" />
            <x-admin.form-textarea name="deskripsi" label="Deskripsi" required="true" />
            <x-admin.form-input name="path_lampiran" label="Path Lampiran" />
            <x-admin.form-button>Simpan</x-admin.form-button>
        </form>
    </div>
</x-admin-layouts>
