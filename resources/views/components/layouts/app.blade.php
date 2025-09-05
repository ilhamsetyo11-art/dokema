<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Aplikasi pendataan magang perusahaan berbasis Laravel dan Tailwind UI.">
    <meta name="keywords" content="magang, dokema, perusahaan, laravel, tailwind, alpinejs, internship">
    <meta name="author" content="Dokema Team">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#2563eb">
    <meta property="og:title" content="Magang - Dokema">
    <meta property="og:description" content="Aplikasi pendataan magang perusahaan berbasis Laravel dan Tailwind UI.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('logo/logo.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Magang - Dokema">
    <meta name="twitter:description" content="Aplikasi pendataan magang perusahaan berbasis Laravel dan Tailwind UI.">
    <meta name="twitter:image" content="{{ asset('logo/logo.png') }}">
    <title>Magang - Dokema</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('logo/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('logo/logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('logo/logo.png') }}" />
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
