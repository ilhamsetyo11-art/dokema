<x-admin-layouts>
    <x-slot name="header">
        Edit Data Magang
    </x-slot>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <form action="{{ route('magang.update', $magang->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <x-input-label for="profil_peserta_id" value="Peserta" />
                <select name="profil_peserta_id" id="profil_peserta_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih Peserta --</option>
                    @foreach ($pesertas as $peserta)
                        <option value="{{ $peserta->id }}" {{ $magang->profil_peserta_id == $peserta->id ? 'selected' : '' }}>{{ $peserta->nim }} - {{ $peserta->universitas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <x-input-label for="pembimbing_id" value="Pembimbing" />
                <select name="pembimbing_id" id="pembimbing_id" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Pembimbing --</option>
                    @foreach ($pembimbings as $pembimbing)
                        <option value="{{ $pembimbing->id }}" {{ $magang->pembimbing_id == $pembimbing->id ? 'selected' : '' }}>{{ $pembimbing->name }} ({{ $pembimbing->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <x-input-label for="path_surat_permohonan" value="Path Surat Permohonan" />
                <x-text-input type="text" name="path_surat_permohonan" id="path_surat_permohonan" class="w-full" value="{{ $magang->path_surat_permohonan }}" required />
            </div>
            <div class="mb-4">
                <x-input-label for="path_surat_balasan" value="Path Surat Balasan" />
                <x-text-input type="text" name="path_surat_balasan" id="path_surat_balasan" class="w-full" value="{{ $magang->path_surat_balasan }}" />
            </div>
            <div class="mb-4">
                <x-input-label for="tanggal_mulai" value="Tanggal Mulai" />
                <x-text-input type="date" name="tanggal_mulai" id="tanggal_mulai" class="w-full" value="{{ $magang->tanggal_mulai }}" required />
            </div>
            <div class="mb-4">
                <x-input-label for="tanggal_selesai" value="Tanggal Selesai" />
                <x-text-input type="date" name="tanggal_selesai" id="tanggal_selesai" class="w-full" value="{{ $magang->tanggal_selesai }}" required />
            </div>
            <div class="mb-4">
                <x-input-label for="status" value="Status" />
                <select name="status" id="status" class="w-full border rounded px-3 py-2">
                    <option value="menunggu" {{ $magang->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="diterima" {{ $magang->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ $magang->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <x-primary-button type="submit">Update</x-primary-button>
        </form>
    </div>
</x-admin-layouts>
