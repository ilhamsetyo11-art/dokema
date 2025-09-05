<div class="mb-4">
    <x-input-label :for="$name" :value="$label" />
    <x-textarea :name="$name" :id="$name" class="w-full border-blue-300 focus:border-blue-900 focus:ring-blue-900 rounded shadow-sm">{{ $value ?? '' }}</x-textarea>
</div>
