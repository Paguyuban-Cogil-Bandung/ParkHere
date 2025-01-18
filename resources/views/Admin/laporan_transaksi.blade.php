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
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                        <h6 class="pt-3">Kelola laporan</h6>
                        <div class="d-flex justify-content-end">
                            <button id="export-csv" class="btn btn-success m-2">Export to CSV</button>
                            <button id="export-pdf" class="btn btn-danger m-2">Export to PDF</button>
                        </div>
                        </div>
                        <hr>
                        <h7 class="pb-2">Filter Laporan</h7>
                        <!-- Filter Form -->
                            @csrf
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label for="status-filter">User Type</label>
                                    <select id="usertype" class="form-control">
                                        <option value="">Select Usertype</option>
                                        <option value="admin" {{ request('usertype') == 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="petugas" {{ request('usertype') == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                        <option value="pelanggan" {{ request('usertype') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="date-start">Email</label>
                                    <input type="text" id="email" class="form-control" placeholder="Email" value="{{ request('email') }}">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="keyword">Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="Name" value="{{ request('name') }}">
                                </div>
                            </div>
                            <button id="filter-btn" class="btn btn-primary mt-3">Filter</button>
                            <button id="reset-btn" class="btn btn-secondary mt-3">Reset Filters</button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive ps-4 pe-4">
                            <table id="laporan" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Created At</th>
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
            autoWidth: true
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

                    if (Array.isArray(response.users)) {
                        // Tambahkan data baru ke DataTable
                        const rows = response.users.map(user => [
                            user.id,
                            user.name,
                            user.email,
                            user.usertype,
                            user.created_at
                        ]);
                        table.rows.add(rows).draw();
                    } else {
                        // Jika tidak ada data
                        table.row.add(['-', '-', 'Tidak ada data yang ditemukan.', '-', '-']).draw();
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching data:", error);
                }
            });
        }

        // Filter button click
        $('#filter-btn').on('click', function () {
            const filters = {
                usertype: $('#usertype').val(),
                email: $('#email').val(),
                name: $('#name').val()
            };
            fetchData(filters);
        });

        // Reset button click
        $('#reset-btn').on('click', function () {
            $('#usertype').val('');
            $('#email').val('');
            $('#name').val('');
            fetchData({}); // Ambil semua data tanpa filter
        });

        // Initial fetch on page load
        fetchData({});

        // Export to CSV
        $('#export-csv').on('click', function () {
            // Get filtered data from DataTable
            var data = table.rows({ search: 'applied' }).data().toArray();

            // Create CSV content
            var csvContent = 'ID,Name,Email,User Type,Created At\n'; // Add headers
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
        });

        // Export to PDF
        $('#export-pdf').on('click', function () {
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
                                ['ID', 'Name', 'Email', 'User Type', 'Created At'],
                                // Data rows
                                ...data.map(item => [
                                    item[0] || '',
                                    item[1] || '',
                                    item[2] || '',
                                    item[3] || '',
                                    item[4] || ''
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
        });
    });
</script>

@endsection