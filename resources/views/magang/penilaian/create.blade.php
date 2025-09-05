<x-admin-layouts>
    <x-slot name="header">
        Buat Penilaian Akhir
    </x-slot>
    <div class="w-full md:w-7/12 xl:w-5/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        <form action="{{ route('penilaian.store', $magangId) }}" method="POST">
            @csrf
            <x-admin.form-input name="nilai" label="Nilai" type="number" min="0" max="100" step="0.01" required="true" />
            <x-admin.form-textarea name="umpan_balik" label="Umpan Balik" />
            <x-admin.form-input name="path_surat_nilai" label="Path Surat Nilai" />
            <x-admin.form-button>Simpan</x-admin.form-button>
        </form>
    </div>
</x-admin-layouts>
