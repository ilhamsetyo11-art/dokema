<x-admin-layouts>
    <x-slot name="header">
        Edit Laporan Kegiatan
    </x-slot>
    <div class="w-full md:w-7/12 xl:w-5/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        <form action="{{ route('laporan.update', [$magangId, $laporan->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <x-admin.form-input name="tanggal_laporan" label="Tanggal Laporan" type="date" :value="$laporan->tanggal_laporan" required="true" />
            <x-admin.form-textarea name="deskripsi" label="Deskripsi" :value="$laporan->deskripsi" required="true" />
            <x-admin.form-input name="path_lampiran" label="Path Lampiran" :value="$laporan->path_lampiran" />
            <x-admin.form-button>Update</x-admin.form-button>
        </form>
    </div>
</x-admin-layouts>
