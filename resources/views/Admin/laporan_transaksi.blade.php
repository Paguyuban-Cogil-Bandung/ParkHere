@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('menu')
    @include('Admin.menu')
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
                                <label for="status-filter">Parkir</label>
                                <select id="parkir" class="form-control">
                                    <option value="">Select Parking Place</option>
                                    @foreach($parkingPlaces as $parkingPlace)
                                        <option value="{{ $parkingPlace->name_place}}" {{ request('parkir') == $parkingPlace->name_place ? 'selected' : '' }}>{{$parkingPlace->name_place}}</option>
                                    @endforeach
                                </select>
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
                                        <th>Tempat</th>
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
            // Initialize DataTable and assign it to a variable
            var table = $('#laporan').DataTable({
                searching: false, // Disable searching
                autoWidth: true,
                paging: false,
            });
            // Fetch data via AJAX
            function fetchData(filters) {
                
                $.ajax({
                    url: "{{ route('admin.laporan_transaksi.data') }}",
                    type: 'GET',
                    data: filters,
                    success: function (response) {
                        console.log(response); // Debug data dari server
                        table.clear(); // Hapus data lama di tabel

                        if (Array.isArray(response.reports)) {
                            // Tambahkan data baru ke DataTable
                            const rows = response.reports.map(report => [
                                report.booking_id,
                                report.name_user,
                                report.name_place,
                                report.metode_bayar,
                                report.durasi,
                                report.total_bayar,
                                report.tambahan_bayar,
                                report.created_at,
                            ]);
                            table.rows.add(rows).draw();
                        } else {
                            // Jika tidak ada data
                            table.row.add(['-', '-', 'Tidak ada data yang ditemukan.', '-', '-']).draw();
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching data:", error);
                    },
                });
            }

            // Filter button click
            $('#filter-btn').on('click', function () {
                $('#filter-loading-spinner').show();
                $('#filter-text').hide();
                const filters = {
                    booking_id: $('#id_booking').val(),
                    parkir: $('#parkir').val(),
                    metode_bayar : $('#metode_bayar').val(),
                    start_time : $('#start_time').val(),
                    end_time : $('#end_time').val(),
                };
                fetchData(filters);
                $('#filter-loading-spinner').hide();
                $('#filter-text').show(); 
            });

            // Reset button click
            $('#reset-btn').on('click', function () {
                $('#reset-loading-spinner').show();
                $('#reset-text').hide();

                $('#id_booking').val('');
                $('#parkir').val('');
                $('#metode_bayar').val('');
                $('#start_time').val('');
                $('#end_time').val('');
                fetchData({}); // Ambil semua data tanpa filter

                $('#reset-loading-spinner').hide();
                $('#reset-text').show();
            });

            // Initial fetch on page load
            fetchData({});

            // Export to CSV
            $('#export-csv').on('click', function () {
                $('#csv-loading-spinner').show();
                $('#csv-text').hide();
                // Get filtered data from DataTable
                var data = table.rows({ search: 'applied' }).data().toArray();

                // Create CSV content
                var csvContent = 'ID Booking,Name,Tempat,Durasi,Total Bayar,Tambahan Bayar,Tanggal\n'; // Add headers
                csvContent += data.map(row => row.join(',')).join('\n'); // Add rows

                // Create a Blob from the CSV content
                var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });

                // Create a download link
                var link = document.createElement('a');
                if (navigator.msSaveBlob) { // For IE
                    navigator.msSaveBlob(blob, 'laporan.csv');
                } else {
                    var url = URL.createObjectURL(blob);
                    link.setAttribute('href', url);
                    link.setAttribute('download', 'laporan.csv');
                    link.style.visibility = 'hidden';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
                $('#csv-loading-spinner').hide();
                $('#csv-text').show();
            });

            // Export to PDF
            $('#export-pdf').on('click', function () {
                $('#pdf-loading-spinner').show();
                $('#pdf-text').hide();
                // Get the DataTable rows as an array of objects
                var data = table.rows({ search: 'applied' }).data().toArray();
                console.log(data); // Debug data yang diambil

                // Define the PDF document structure
                var docDefinition = {
                    content: [
                        {
                            table: {
                                headerRows: 1,
                                body: [
                                    // Header row
                                    ['ID Booking', 'Name', 'Tempat', 'Metode Bayar', 'Durasi', 'Total Bayar', 'Tambahan Bayar', 'Tanggal'],
                                    // Data rows
                                    ...data.map(item => [
                                        item[0] || '',
                                        item[1] || '',
                                        item[2] || '',
                                        item[3] || '',
                                        item[4] || '',
                                        item[5] || '',
                                        item[6] || '',
                                        item[7] || '',
                                    ])
                                ]
                            }
                        }
                    ],
                    styles: {
                        table: {
                            margin: [0, 5, 0, 15]
                        },
                        header: {
                            fontSize: 10,
                            bold: true,
                            color: 'black'
                        },
                        tableHeader: {
                            bold: true,
                            fontSize: 10,
                            color: 'black'
                        },
                        tableBody: {
                            fontSize: 9,
                            color: 'black'
                        }
                    }
                };

                // Create and download the PDF
                pdfMake.createPdf(docDefinition).download('laporan.pdf');
                $('#pdf-loading-spinner').hide();
                $('#pdf-text').show();
            });
        });
    </script>
@endsection