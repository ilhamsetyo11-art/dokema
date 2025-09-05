<x-admin-layouts>
    <x-slot name="header">
        Edit Penilaian Akhir
    </x-slot>
    <div class="w-full md:w-7/12 xl:w-5/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        <form action="{{ route('penilaian.update', [$magangId, $penilaian->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <x-admin.form-input name="nilai" label="Nilai" type="number" min="0" max="100" step="0.01" :value="$penilaian->nilai" required="true" />
            <x-admin.form-textarea name="umpan_balik" label="Umpan Balik" :value="$penilaian->umpan_balik" />
            <x-admin.form-input name="path_surat_nilai" label="Path Surat Nilai" :value="$penilaian->path_surat_nilai" />
            <x-admin.form-button>Update</x-admin.form-button>
        </form>
    </div>
</x-admin-layouts>
