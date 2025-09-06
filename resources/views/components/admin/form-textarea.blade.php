<div class="mb-4">
    <x-input-label :for="$name" :value="$label" />
    <x-textarea :name="$name" :id="$name" :placeholder="$placeholder ?? ''" :required="$required ?? false" class="mt-1" :rows="$rows ?? 4">{{ $value ?? '' }}</x-textarea>
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
