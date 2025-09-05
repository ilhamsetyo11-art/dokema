<div class="min-h-screen bg-blue-50 flex flex-col">
    <x-admin.header />
    <div class="flex flex-1">
        <aside class="hidden md:block w-64 bg-blue-900 text-white py-8 px-4">
            <!-- Sidebar menu -->
            <nav class="space-y-4">
                <a href="/" class="block py-2 px-4 rounded hover:bg-blue-800">Dashboard</a>
                <a href="{{ route('profil.index') }}" class="block py-2 px-4 rounded hover:bg-blue-800">Profil Pemagang</a>
                <a href="{{ route('magang.index') }}" class="block py-2 px-4 rounded hover:bg-blue-800">Data Magang</a>
                <a href="{{ route('laporan.index') }}" class="block py-2 px-4 rounded hover:bg-blue-800">Laporan Kegiatan</a>
                <a href="{{ route('bimbingan.index') }}" class="block py-2 px-4 rounded hover:bg-blue-800">Log Bimbingan</a>
                <a href="{{ route('penilaian.index') }}" class="block py-2 px-4 rounded hover:bg-blue-800">Penilaian Akhir</a>
                <a href="{{ route('user.index') }}" class="block py-2 px-4 rounded hover:bg-blue-800">Manajemen User</a>
            </nav>
        </aside>
        <main class="flex-1 px-2 md:px-8 py-8">
            {{ $slot }}
        </main>
    </div>
</div>
