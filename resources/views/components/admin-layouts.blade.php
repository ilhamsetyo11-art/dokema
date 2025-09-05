<x-layouts.app>
    <div>
        @if (isset($header))
            <div class="mb-6">
                <h3 class="text-2xl font-semibold text-gray-900">{{ $header }}</h3>
            </div>
        @endif
        {{ $slot }}
    </div>
</x-layouts.app>
