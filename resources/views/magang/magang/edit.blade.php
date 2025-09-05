<x-admin-layouts>
    <x-slot name="header">
        Edit Data Magang
    </x-slot>
    <div class="w-full md:w-7/12 xl:w-5/12 mx-auto mt-8 p-4 md:p-8 bg-white rounded shadow-md">
        <form action="{{ route('magang.update', $magang->id) }}" method="POST">
            @csrf
            @method('PUT')
            <x-admin.form-select name="profil_peserta_id" label="Peserta" required="true">
                <option value="">-- Pilih Peserta --</option>
                @foreach ($pesertas as $peserta)
                    <option value="{{ $peserta->id }}" {{ $magang->profil_peserta_id == $peserta->id ? 'selected' : '' }}>{{ $peserta->nim }} - {{ $peserta->universitas }}</option>
                @endforeach
            </x-admin.form-select>
            <x-admin.form-select name="pembimbing_id" label="Pembimbing">
                <option value="">-- Pilih Pembimbing --</option>
                @foreach ($pembimbings as $pembimbing)
                    <option value="{{ $pembimbing->id }}" {{ $magang->pembimbing_id == $pembimbing->id ? 'selected' : '' }}>{{ $pembimbing->name }} ({{ $pembimbing->email }})</option>
                @endforeach
            </x-admin.form-select>
            <x-admin.form-input name="path_surat_permohonan" label="Path Surat Permohonan" :value="$magang->path_surat_permohonan" required="true" />
            <x-admin.form-input name="path_surat_balasan" label="Path Surat Balasan" :value="$magang->path_surat_balasan" />
            <x-admin.form-input name="tanggal_mulai" label="Tanggal Mulai" type="date" :value="$magang->tanggal_mulai" required="true" />
            <x-admin.form-input name="tanggal_selesai" label="Tanggal Selesai" type="date" :value="$magang->tanggal_selesai" required="true" />
            <x-admin.form-select name="status" label="Status">
                <option value="menunggu" {{ $magang->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="diterima" {{ $magang->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="ditolak" {{ $magang->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </x-admin.form-select>
            <x-admin.form-button>Update</x-admin.form-button>
        </form>
    </div>
</x-admin-layouts>
