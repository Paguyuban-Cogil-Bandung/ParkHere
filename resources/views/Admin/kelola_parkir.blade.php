@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('menu')
    @include('Admin.menu')
@endsection

@section('title')
    Kelola Parkir
@endsection

@section('content')
    @include('layout.navbars.auth.topnav', ['title' => 'Kelola Parkir'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Kelola Parkir</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive ps-4 pe-4">
                            <table id="parkir" class="table align-items-center mb-0">
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    new DataTable('#parkir', {
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
    processing: true,
    serverSide: true,
});

// Event delegation for dynamically created buttons
$('#parkir').on('click', '.update-btn', function (e) {
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
                            $('#parkir').DataTable().ajax.reload();
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

$('#parkir').on('click', '.delete-btn', function (e) {
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
                    $('#parkir').DataTable().ajax.reload();
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
