<header class="lg:hidden bg-white shadow-md sticky top-0 z-40">
    <div class="container mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="/" class="text-xl font-medium text-gray-800">
                Magang Panel
            </a>
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600 lg:hidden">
                <x-lucide-menu class="h-6 w-6" />
            </button>
        </div>
    </div>
</header>
