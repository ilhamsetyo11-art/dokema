<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Magang - Dokema</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/logo-fill.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('logo/logo-fill.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('logo/logo-fill.png') }}" />
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="font-sans antialiased">
    <div x-data="{ sidebarOpen: false }" class="flex h-screen">
        <x-sidebar />
        <div class="flex-1 flex flex-col overflow-hidden">
            <x-admin-header />
            <main class="flex-1 overflow-x-hidden overflow-y-auto">
                <div class="container px-6 py-4 mx-auto">
                    @if (isset($header))
                        <h3 class="text-2xl font-semibold text-gray-900">{{ $header }}</h3>
                    @endif
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</body>

</html>
