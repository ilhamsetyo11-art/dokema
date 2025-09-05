<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-blue-900 hover:bg-blue-800 text-white font-semibold px-6 py-2 rounded shadow']) }}>
    {{ $slot }}
</button>
