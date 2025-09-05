<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Penilaian Akhir</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-50">
    <x-admin-layouts>
        <x-slot name="header">
            Buat Penilaian Akhir
        </x-slot>
        <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
            <form action="{{ route('penilaian.store', $magangId) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <x-input-label for="nilai" value="Nilai" />
                    <x-text-input type="number" name="nilai" id="nilai" min="0" max="100" step="0.01" class="w-full" required />
                </div>
                <div class="mb-4">
                    <x-input-label for="umpan_balik" value="Umpan Balik" />
                    <x-textarea name="umpan_balik" id="umpan_balik" class="w-full" />
                </div>
                <div class="mb-4">
                    <x-input-label for="path_surat_nilai" value="Path Surat Nilai" />
                    <x-text-input type="text" name="path_surat_nilai" id="path_surat_nilai" class="w-full" />
                </div>
                <x-primary-button type="submit">Simpan</x-primary-button>
            </form>
        </div>
    </x-admin-layouts>
</body>

</html>
