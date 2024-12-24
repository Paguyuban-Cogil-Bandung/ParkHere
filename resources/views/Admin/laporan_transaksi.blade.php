@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('menu')
    @include('Admin.menu')
@endsection

@section('content')
    @include('layout.navbars.auth.topnav', ['title' => 'Tables'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                        <h6 class="pt-3">Kelola laporan</h6>
                        <div class="d-flex justify-content-end">
                            <button id="export-excel" class="btn btn-success m-2">Export to Excel</button>
                            <button id="export-pdf" class="btn btn-danger m-2">Export to PDF</button>
                        </div>
                        </div>
                        <hr>
                        <h7 class="pb-2">Filter Laporan</h7>
                        <!-- Filter Form -->
                        <form id="filter-form" class="mb-3 mt-2">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <label for="status-filter">User Type</label>
                                    <select id="status-filter" class="form-control">
                                        <option value="">Select Usertype</option>
                                        <option value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>
                                        <option value="pelanggan">Pelanggan</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="date-start">Date Start</label>
                                    <input type="date" id="date-start" class="form-control" placeholder="Start Date">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="date-end">Date End</label>
                                    <input type="date" id="date-end" class="form-control" placeholder="End Date">
                                </div>
                                <div class="col-md-3 mb-2">
                                    <label for="keyword">Keyword</label>
                                    <input type="text" id="keyword" class="form-control" placeholder="Keyword">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Filter</button>
                            <button type="button" id="reset-filters" class="btn btn-secondary mt-3">Reset Filters</button>
                            
                        </form>
                        
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
                                    <!-- Data will be populated by DataTables -->
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
        // DataTable
        var table = $('#laporan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'https://parkhere-backend.ourproject.my.id/user/list',
                type: 'GET',
            },
            columns: [
                { data: 'id'},
                { data: 'name' },
                { data: 'email' },
                { data: 'usertype'},
                { data: 'created_at'},
                { data: 'password', visible: false },
                { data: 'updated_at', visible: false },
            ],
            
        });

        const minEl = document.querySelector('#status-filter');
        const maxEl = document.querySelector('#keyboard');
        
        
        // Custom range filtering function
        
        // Changes to the inputs will trigger a redraw to update the table
        // minEl.addEventListener('input', function () {
        //     tables.draw();
        // });
        maxEl.addEventListener('input', function (e) {
            table.draw();
        });
    
        // Export to Excel
    $('#export-excel').on('click', function() {
        var data = table.rows({ search: 'applied' }).data().toArray();
        var wb = XLSX.utils.book_new();
        var ws = XLSX.utils.json_to_sheet(data);
        XLSX.utils.book_append_sheet(wb, ws, "Laporan");
        XLSX.writeFile(wb, "laporan.xlsx");
    });

    // Export to PDF
    $('#export-pdf').on('click', function() {
        var data = table.rows({ search: 'applied' }).data().toArray();
        var docDefinition = {
            content: [
                {
                    table: {
                        body: [
                            ['ID', 'Name', 'Email', 'User  Type', 'Created At'],
                            ...data.map(item => [item.id, item.name, item.email, item.usertype,
                            item.created_at])
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
                subheader: {
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

        pdfMake.createPdf(docDefinition).download('laporan.pdf');
    });
});
</script>
@endsection