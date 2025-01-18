@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('menu')
    @include('Admin.menu')
@endsection

@section('title')
    User Management
@endsection

@section('content')
    @include('layout.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6>User List</h6>
                            <button id="add-user-btn" class="add-btn btn btn-primary btn-sm" >Tambah<i class="fe fe-add"></i></button>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive ps-4 pe-4">
                            <table id="users" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bcryptjs/2.2.0/bcrypt.js" async></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    new DataTable('#users', {
    ajax: 'https://parkhere-backend.ourproject.my.id/user/list',
    columns: [
        { data: 'id' },
        { data: 'name' },
        { data: 'email' },
        {
            data: 'usertype',
            render: function (data, type, row) {
                // Determine the text color based on usertype
                let Bgclass = '';
                if (data === 'admin') {
                    Bgclass = 'primary'; // Red for admin
                } else if (data === 'pelanggan') {
                    Bgclass = 'info'; // Blue for pelanggan
                } else if (data === 'petugas') {
                    Bgclass = 'secondary'; // Yellow for petugas
                }
                return `<span class="p-2 bg-${Bgclass} rounded text-white">${data}</span>`;
            }
        },
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
    processing: true,
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
                <div class="mb-3">
                    <label for="edit-user-name" class="form-label" style="text-align: left;">Name</label>
                    <input type="text" id="swal-input-name" class="form-control" id="edit-user-name" value="${user.name}" required>
                </div>
                <div class="mb-3">
                    <label for="edit-user-email" class="form-label">Email</label>
                    <input type="email" id="swal-input-email" class="form-control" id="edit-user-email" value="${user.email}" required>
                </div>
                <div class="mb-3">
                    <label for="edit-user-password" class="form-label">Password</label>
                    <input type="password" id="swal-input-password" class="form-control" id="edit-user-password">
                </div>
                <div class="mb-3">
                    <label for="edit-user-usertype" class="form-label">User Type</label>
                    <select class="form-select" id="swal-input-usertype" required>
                    <option value="admin" ${user.usertype === 'admin' ? 'selected' : ''}>Admin</option>
                        <option value="petugas" ${user.usertype === 'petugas' ? 'selected' : ''}>Petugas</option>
                        <option value="pelanggan" ${user.usertype === 'pelanggan' ? 'selected' : ''}>Pelanggan</option>
                    </select>
                </div>
                `,
                focusConfirm: true,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: "Save",
                denyButtonText: `Don't save`,
                preConfirm: async () => {
                    const name = document.getElementById('swal-input-name').value;
                    const email = document.getElementById('swal-input-email').value;
                    const password = document.getElementById('swal-input-password').value;
                    const usertype = document.getElementById('swal-input-usertype').value;

                    // Validate inputs
                    if (!name || !email || !usertype) {
                        Swal.showValidationMessage('Please fill in all fields');
                    }
                    const response = await fetch('/api/hashpw', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{csrf_token()}}' // Sertakan token CSRF di header
                        },
                        body: JSON.stringify({
                            password: password
                        })
                    });

                    const data = await response.json();
                    console.log(data);

                    return { name, email, password: data.hash,  usertype };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send updated data to the API
                    $.ajax({
                        url: `https://parkhere-backend.ourproject.my.id/user/${userId}`, // Adjust the URL as needed
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
                else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
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

$('#add-user-btn').on('click', function () {
    // Open SweetAlert untuk form input
    Swal.fire({
        title: 'New User',
        html:`
        <div class="alert" id"alert">
            <div class="mb-3">
                <label for="edit-user-name" class="form-label text-start">Name</label>
                <input type="text" class="form-control" id="swal-input-name" required>
            </div>
            <div class="mb-3">
                <label for="edit-user-email" class="form-label">Email</label>
                <input type="email" class="form-control" id="swal-input-email" required>
            </div>
            <div class="mb-3">
                <label for="edit-user-password" class="form-label">Password</label>
                <input type="password" class="form-control" id="swal-input-password">
            </div>
            <div class="mb-3">
                <label for="edit-user-usertype" class="form-label">User Type</label>
                <select class="form-select" id="swal-input-usertype" required>
                    <option value="" disabled>Select User Type</option>
                    <option value="admin">Admin</option>
                    <option value="petugas">Petugas</option>
                    <option value="pelanggan">Pelanggan</option>
                </select>
            </div>
        </div>
        `,
        focusConfirm: true,
        showCancelButton: true,
        preConfirm: async () => {
            const name = document.getElementById('swal-input-name').value;
            const email = document.getElementById('swal-input-email').value;
            const password = document.getElementById('swal-input-password').value;
            const usertype = document.getElementById('swal-input-usertype').value;
            // Validasi input
            if (!name || !email || !password || !usertype) {
                Swal.showValidationMessage('Please fill in all fields');
            }
            const response = await fetch('/api/hashpw', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{csrf_token()}}' // Sertakan token CSRF di header
                },
                body: JSON.stringify({
                    password: password
                })
            });

            const data = await response.json();
            console.log(data);

            return { name, email, password: data.hash, usertype };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Kirim data baru ke API
            $.ajax({
                url: 'https://parkhere-backend.ourproject.my.id/user/', // Sesuaikan endpoint API
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(result.value),
                success: function (response) {
                    Swal.fire(
                        'Added!',
                        'New user has been added.',
                        'success'
                    );
                    // Reload DataTable
                    $('#users').DataTable().ajax.reload();
                },
                error: function (xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'There was an error adding the user.',
                        'error'
                    );
                }
            });
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
                url: `https://parkhere-backend.ourproject.my.id/user/${userId}`, // Adjust the URL as needed
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
