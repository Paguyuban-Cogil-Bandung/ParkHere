@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])
<!-- Menu -->
@section('menu')
    @include('Petugas.menu')
@endsection
<!-- content -->
@section('title')
    Dashboard
@endsection

@section('content')
    @include('layout.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-6 col-sm-6 col-xl-3 order-1 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Slot Tersedia</p>
                                    <h6 class="font-weight-bolder">
                                        50
                                    </h6>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-xl-3 order-3 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Booking Pending</p>
                                    <h6 class="font-weight-bolder">
                                        2,300
                                    </h6>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-xl-3 order-2 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Slot Yang Terisi</p>
                                    <h6 class="font-weight-bolder">
                                        30
                                    </h6>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-xl-3 order-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Transaksi Hari Ini</p>
                                    <h6 class="font-weight-bolder">
                                        103.000.000
                                    </h6>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Pantauan</h6>
                    </div>
                    <div class="card-body p-3">
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/xpgiCNO1uAA?si=NSzZG5VJBHuSzkep" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Daftar Transaksi</h6>
                        </div>
                    </div>
                    <div class="table-responsive ps-4 pe-4">
                        <table id="users" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>ID Booking</th>
                                    <th>No Plat</th>
                                    <th>Total Jam Parkir</th>
                                    <th>Bayar</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('layout.footers.auth.footer')
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    new DataTable('#users', {
    ajax: 'https://parkhere-backend.ourproject.my.id/user/list',
    columns: [
        { data: 'id' },
        { data: 'name' },
        { data: 'email' },
        { data: 'usertype' },
        { data: 'created_at' },
        {
            data: null,
            className: "dt-center editor-delete",
            orderable: false,
            "mRender": function (data, type, row) {
                return `<button class="update-btn btn btn-secondary btn-sm" data-id="${data.id}" data-name="${data.name}">Edit <i class="fe fe-edit"></i></button> 
                        <button class="delete-btn btn btn-danger btn-sm" data-id="${data.id}" data-name="${data.name}">Delete <i class="fe fe-delete"></i></button>`;
            }
        },
        { data: 'updated_at', visible: false },
        { data: 'password', visible: false },
    ],
    processing: false,
    serverSide: true,
    order: {},
});

// Event delegation for dynamically created buttons
$('#users').on('click', '.update-btn', function (e) {
    e.preventDefault();
    const userId = $(this).data('id');

    // Fetch user data from the API
    $.ajax({
        url: `https://parkhere-backend.ourproject.my.id/user/${userId}`, // Adjust the URL as needed
        type: 'GET',
        success: function (user) {
            // Open SweetAlert with input fields
            Swal.fire({
                title: 'Edit User',
                html: `
                    <input id="swal-input-name" class="swal2-input" placeholder="Name" value="${user.name}">
                    <input id="swal-input-email" class="swal2-input" placeholder="Email" value="${user.email}">
                    <input id="swal-input-usertype" class="swal2-input" placeholder="User  Type" value="${user.usertype}">
                `,
                focusConfirm: false,
                preConfirm: () => {
                    const name = document.getElementById('swal-input-name').value;
                    const email = document.getElementById('swal-input-email').value;
                    const usertype = document.getElementById('swal-input-usertype').value;

                    // Validate inputs
                    if (!name || !email || !usertype) {
                        Swal.showValidationMessage('Please fill in all fields');
                    }

                    return { name, email, usertype };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send updated data to the API
                    $.ajax({
                        url: `https://parkhere-backend.ourproject.my.id/user/update/${userId}`, // Adjust the URL as needed
                        type: 'PUT',
                        contentType: 'application/json',
                        data: JSON.stringify(result.value),
                        success: function (response) {
                            Swal.fire(
                                'Updated!',
                                'User  details have been updated.',
                                'success'
                            );
                            // Reload the DataTable
                            $('#users').DataTable().ajax.reload();
                        },
                        error: function (xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'There was an error updating the user.',
                                'error'
                            );
                        }
                    });
                }
            });
        },
        error: function (xhr, status, error) {
            Swal.fire(
                'Error!',
                'Could not fetch user data.',
                'error'
            );
        }
    });
});

$('#users').on('click', '.delete-btn', function (e) {
    e.preventDefault();
    const userId = $(this).data('id');
    const userName = $(this).data('name');

    // SweetAlert for delete confirmation
    Swal.fire({
        title: 'Apa kamu yakin?',
        text: `Data : ${userName} akan dihapus`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Call the delete API endpoint
            $.ajax({
                url: `https://parkhere-backend.ourproject.my.id/user/delete/${userId}`, // Adjust the URL as needed
                type: 'DELETE',
                success: function (response) {
                    // Handle success response
                    Swal.fire(
                        'Dihapus!',
                        'Data berhasil dihapus.',
                        'success'
                    );
                    // Reload the DataTable
                    $('#users').DataTable().ajax.reload();
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    Swal.fire(
                        'Error!',
                        'Data gagal dihapus.',
                        'error'
                    );
                }
            });
        }
    });
});
</script>
@endsection
