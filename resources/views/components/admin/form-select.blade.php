<div class="mb-4">
    <x-input-label :for="$name" :value="$label" />
    <select name="{{ $name }}" id="{{ $name }}" {{ $attributes->merge(['class' => 'mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm']) }} @if ($required ?? false) required @endif>
        @if ($placeholder ?? null)
            <option value="">{{ $placeholder }}</option>
        @endif
        {{ $slot }}
    </select>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
