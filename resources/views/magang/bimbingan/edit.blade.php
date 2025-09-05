<x-admin-layouts>
    <x-slot name="header">
        Edit Log Bimbingan
    </x-slot>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <form action="{{ route('bimbingan.update', [$magangId, $log->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <x-input-label for="waktu_bimbingan" value="Waktu Bimbingan" />
                <x-text-input type="datetime-local" name="waktu_bimbingan" id="waktu_bimbingan" value="{{ $log->waktu_bimbingan }}" class="w-full" required />
            </div>
            <div class="mb-4">
                <x-input-label for="catatan_peserta" value="Catatan Peserta" />
                <x-textarea name="catatan_peserta" id="catatan_peserta" class="w-full">{{ $log->catatan_peserta }}</x-textarea>
            </div>
            <div class="mb-4">
                <x-input-label for="catatan_pembimbing" value="Catatan Pembimbing" />
                <x-textarea name="catatan_pembimbing" id="catatan_pembimbing" class="w-full">{{ $log->catatan_pembimbing }}</x-textarea>
            </div>
            <x-primary-button type="submit">Update</x-primary-button>
        </form>
    </div>
</x-admin-layouts>
