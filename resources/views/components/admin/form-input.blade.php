<div class="mb-4">
    <x-input-label :for="$name" :value="$label" />
    <x-text-input :type="$type ?? 'text'" :name="$name" :id="$name" :value="$value ?? ''" :required="$required ?? false" :placeholder="$placeholder ?? ''" class="mt-1" />
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
