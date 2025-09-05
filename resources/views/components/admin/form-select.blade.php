<div class="mb-4">
    <x-input-label :for="$name" :value="$label" />
    <select name="{{ $name }}" id="{{ $name }}" class="w-full border-blue-300 focus:border-blue-900 focus:ring-blue-900 rounded shadow-sm px-3 py-2">
        {{ $slot }}
    </select>
</div>
