@php
    $activeClasses = 'bg-gray-800 text-white';
    $inactiveClasses = 'text-gray-600 hover:bg-gray-200';
@endphp
<sidebar class="fixed inset-y-0 left-0 z-50 w-64 overflow-y-auto transition duration-300 transform bg-gray-50 border-r border-gray-200 lg:translate-x-0 lg:static lg:inset-0" :class="{ 'translate-x-0 ease-out': sidebarOpen, '-translate-x-full ease-in': !sidebarOpen }">
    <div class="flex items-center justify-start h-16 px-6 border-b border-gray-200">
        <a href="/" class="text-xl font-medium text-gray-800">
            Magang Panel
        </a>
    </div>
    <nav class="mt-4 space-y-2 px-3">
        <div>
            <a href="{{ route('profil.index') }}" class="px-3 py-2 flex items-center rounded-sm {{ request()->routeIs('profil.*') ? $activeClasses : $inactiveClasses }}">
                <x-lucide-user class="h-5 w-5" />
                <span class="mx-3">Profil</span>
            </a>
        </div>
        <div>
            <a href="{{ route('magang.index') }}" class="px-3 py-2 flex items-center rounded-sm {{ request()->routeIs('magang.*') ? $activeClasses : $inactiveClasses }}">
                <x-lucide-briefcase class="h-5 w-5" />
                <span class="mx-3">Magang</span>
            </a>
        </div>
        <div>
            <a href="{{ route('laporan.index', 1) }}" class="px-3 py-2 flex items-center rounded-sm {{ request()->routeIs('laporan.*') ? $activeClasses : $inactiveClasses }}">
                <x-lucide-file-text class="h-5 w-5" />
                <span class="mx-3">Laporan</span>
            </a>
        </div>
        <div>
            <a href="{{ route('bimbingan.index', 1) }}" class="px-3 py-2 flex items-center rounded-sm {{ request()->routeIs('bimbingan.*') ? $activeClasses : $inactiveClasses }}">
                <x-lucide-book-open class="h-5 w-5" />
                <span class="mx-3">Bimbingan</span>
            </a>
        </div>
        <div>
            <a href="{{ route('penilaian.index', 1) }}" class="px-3 py-2 flex items-center rounded-sm {{ request()->routeIs('penilaian.*') ? $activeClasses : $inactiveClasses }}">
                <x-lucide-star class="h-5 w-5" />
                <span class="mx-3">Penilaian</span>
            </a>
        </div>
        <div>
            <a href="/logout" class="px-3 py-2 flex items-center rounded-sm text-red-600 hover:bg-red-200 hover:text-red-800">
                <x-lucide-log-out class="h-5 w-5" />
                <span class="mx-3">Logout</span>
            </a>
        </div>
    </nav>
</sidebar>
