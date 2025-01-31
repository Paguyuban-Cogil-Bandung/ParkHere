@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('menu')
    @include('Petugas.menu')
@endsection

@section('title')
    Laporan Transaksi
@endsection

@section('content')
    @include('layout.navbars.auth.topnav', ['title' => 'Laporan Transaksi'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body pb-0">
                        <div class="d-flex justify-content-between">
                            <h6 class="pt-3">Kelola laporan</h6>
                            <div class="d-flex justify-content-end">
                                <button id="export-csv" class="btn btn-success m-2">
                                    <span id="csv-text">Export to CSV</span>
                                    <div id="csv-loading-spinner" style="display: none;">
                                        <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
                                    </div>
                                </button>
                                <button id="export-pdf" class="btn btn-danger m-2">
                                    <span id="pdf-text">Export to PDF</span>
                                    <div id="pdf-loading-spinner" style="display: none;">
                                        <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
                                    </div>
                                </button>
                            </div>
                        </div>
                        <hr>
                        <h7 class="pb-2">Filter Laporan</h7>
                        <!-- Filter Form -->
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-2">
                                <label for="date-start">ID Booking</label>
                                <input type="text" id="id_booking" class="form-control" placeholder="ID Booking" value="{{ request('booking_id') }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="status-filter">Metode Bayar</label>
                                <select id="metode_bayar" class="form-control">
                                    <option value="">Select Metode Bayar</option>
                                    <option value="transfer" {{ request('metode_bayar') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                                    <option value="dipetugas" {{ request('metode_bayar') == 'dipetugas' ? 'selected' : '' }}>Di Petugas</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="date-start">Tanggal Awal</label>
                                <input type="date" id="start_time" class="form-control" placeholder="Email" value="{{ request('start_time') }}">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="keyword">Tanggal Akhir</label>
                                <input type="date" id="end_time" class="form-control" placeholder="" value="{{ request('end_time') }}">
                            </div>
                        </div>
                        <!-- Tambahkan elemen spinner/loading -->

                        <button id="filter-btn" class="btn btn-primary mt-3">
                            <span id="filter-text">Filter</span>
                            <div id="filter-loading-spinner" style="display: none;">
                                <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
                            </div>
                        </button>
                        <button id="reset-btn" class="btn btn-secondary mt-3">
                            <span id="reset-text">Reset Filters</span>
                            <div id="reset-loading-spinner" style="display: none;">
                                <span class="spinner-border spinner-border-sm text-white" role="status" aria-hidden="true"></span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-2 pb-2">
                        <div class="table-responsive ps-4 pe-4">
                            <table id="laporan" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>ID Booking</th>
                                        <th>Name</th>
                                        <th>Metode Bayar</th>
                                        <th>Durasi</th>
                                        <th>Total Bayar</th>
                                        <th>Tambahan Bayar</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data will be loaded dynamically -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('js')
    <!-- Include XLSX for Excel export -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <!-- Include pdfmake for PDF export -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(document).ready(function () {
        var table = $('#laporan').DataTable({
            searching: false,
            autoWidth: true,
            paging: false,
        });
    
        function fetchData(filters) {
            $.ajax({
                url: "{{ route('petugas.laporan_transaksi.data') }}",
                type: 'GET',
                data: filters,
                success: function (response) {
                    console.log(response);
                    table.clear();
    
                    if (Array.isArray(response.reports) && response.reports.length > 0) {
                        const rows = response.reports.map(report => [
                            report.booking_id,
                            report.name_user,
                            report.metode_bayar,
                            report.durasi,
                            report.total_bayar,
                            report.tambahan_bayar,
                            report.created_at,
                        ]);
                        table.rows.add(rows).draw();
                    } else {
                        table.row.add(['-', '-', 'Tidak ada data.', '-', '-', '-', '-', '-']).draw();
                    }
    
                    $('#filter-loading-spinner').hide();
                    $('#filter-text').show();
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching data:", error);
                    alert("Terjadi kesalahan saat mengambil data.");
                    $('#filter-loading-spinner').hide();
                    $('#filter-text').show();
                }
            });
        }
    
        $('#filter-btn').on('click', function () {
            $('#filter-loading-spinner').show();
            $('#filter-text').hide();
            
            const filters = {
                booking_id: $('#id_booking').val(),
                metode_bayar: $('#metode_bayar').val(),
                start_time: $('#start_time').val(),
                end_time: $('#end_time').val(),
            };
            
            fetchData(filters);
        });
    
        $('#reset-btn').on('click', function () {
            $('#reset-loading-spinner').show();
            $('#reset-text').hide();
    
            $('#id_booking, #metode_bayar, #start_time, #end_time').val('');
            fetchData({});
    
            $('#reset-loading-spinner').hide();
            $('#reset-text').show();
        });
    
        fetchData({});
    
        $('#export-csv').on('click', function () {
            $('#csv-loading-spinner').show();
            $('#csv-text').hide();
    
            var data = table.rows({ search: 'applied' }).data().toArray();
            var csvContent = 'ID Booking,Name,Metode Bayar,Durasi,Total Bayar,Tambahan Bayar,Tanggal\n';
            csvContent += data.map(row => row.join(',')).join('\n');
    
            var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            var link = document.createElement('a');
    
            if (navigator.msSaveBlob) {
                navigator.msSaveBlob(blob, 'laporan.csv');
            } else {
                var url = URL.createObjectURL(blob);
                link.setAttribute('href', url);
                link.setAttribute('download', 'laporan.csv');
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
    
            $('#csv-loading-spinner').hide();
            $('#csv-text').show();
        });
    
        $('#export-pdf').on('click', function () {
            $('#pdf-loading-spinner').show();
            $('#pdf-text').hide();
    
            var data = table.rows({ search: 'applied' }).data().toArray();
    
            var docDefinition = {
                content: [
                    {
                        table: {
                            headerRows: 1,
                            body: [
                                ['ID Booking', 'Name', 'Metode Bayar', 'Durasi', 'Total Bayar', 'Tambahan Bayar', 'Tanggal'],
                                ...data.map(row => row.map(cell => cell || ''))
                            ]
                        }
                    }
                ]
            };
    
            pdfMake.createPdf(docDefinition).download('laporan.pdf');
    
            $('#pdf-loading-spinner').hide();
            $('#pdf-text').show();
        });
    });
</script>
@endsection