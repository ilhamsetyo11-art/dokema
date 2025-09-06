<div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
    <div class="overflow-x-auto">
        <table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-300']) }} id="{{ $attributes->get('id', 'dataTable') }}">
            <thead class="bg-gray-50">
                {{ $thead }}
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableId = '{{ $attributes->get('id', 'dataTable') }}';
            const table = document.getElementById(tableId);

            if (table && typeof DataTable !== 'undefined') {
                new DataTable('#' + tableId, {
                    responsive: true,
                    pageLength: 10,
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "Semua"]
                    ],
                    order: [],
                    columnDefs: [{
                        targets: 'no-sort',
                        orderable: false,
                    }]
                });
            }
        });
    </script>
@endpush
