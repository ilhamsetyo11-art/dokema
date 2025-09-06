<div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
                {{ $thead }}
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>
