import './bootstrap';
import 'datatables.net-dt/css/dataTables.dataTables.css';
import 'datatables.net-responsive-dt/css/responsive.dataTables.css';
import DataTable from 'datatables.net';
import 'datatables.net-responsive';

// Initialize DataTables
window.DataTable = DataTable;

// Global DataTable configuration
DataTable.defaults.responsive = true;
DataTable.defaults.language = {
    "processing": "Memproses...",
    "search": "Pencarian:",
    "lengthMenu": "Tampilkan _MENU_ data",
    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
    "infoFiltered": "(disaring dari _MAX_ total data)",
    "loadingRecords": "Memuat...",
    "zeroRecords": "Tidak ditemukan data yang sesuai",
    "emptyTable": "Tidak ada data tersedia",
    "paginate": {
        "first": "Pertama",
        "previous": "Sebelumnya",
        "next": "Selanjutnya",
        "last": "Terakhir"
    }
};
