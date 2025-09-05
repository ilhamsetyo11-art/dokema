<div class="mb-4">
    <x-input-label :for="$name" :value="$label" />
    <x-text-input :type="$type ?? 'text'" :name="$name" :id="$name" :value="$value ?? ''" class="w-full border-blue-300 focus:border-blue-900 focus:ring-blue-900 rounded shadow-sm" :required="$required ?? false" />
</div>
