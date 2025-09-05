<x-admin-layouts>
    <x-slot name="header">
        Tambah Log Bimbingan
    </x-slot>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <form action="{{ route('bimbingan.store', $magangId) }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-input-label for="waktu_bimbingan" value="Waktu Bimbingan" />
                <x-text-input type="datetime-local" name="waktu_bimbingan" id="waktu_bimbingan" class="w-full" required />
            </div>
            <div class="mb-4">
                <x-input-label for="catatan_peserta" value="Catatan Peserta" />
                <x-textarea name="catatan_peserta" id="catatan_peserta" class="w-full" />
            </div>
            <div class="mb-4">
                <x-input-label for="catatan_pembimbing" value="Catatan Pembimbing" />
                <x-textarea name="catatan_pembimbing" id="catatan_pembimbing" class="w-full" />
            </div>
            <x-primary-button type="submit">Simpan</x-primary-button>
        </form>
    </div>
</x-admin-layouts>
