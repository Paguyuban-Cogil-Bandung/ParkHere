@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])
@section('menu')
    @include('Admin.menu')
@endsection

@section('title')
    Kelola Parkir
@endsection

@section('content')
    @include('layout.navbars.auth.topnav', ['title' => 'Kelola Parkir'])
        {{-- <button class="btn btn-danger">Tambah</button> --}}
        <div class="container-fluid p-4">
            {{-- <div class="row"> --}}
                <div class="card bg-transparent">
                <div class="d-flex justify-content-end align-items-center pt-2 ">
                    <button class="btn btn-secondary">Tambah Tempat Parkir</button>
                </div>
                </div>
            {{-- </div> --}}
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">ParkHere Unikom Bandung</h6>
                                <span class="mb-0">2.5 KM</span>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group ">
                                <img src="{{ asset('/assets') }}/guest/images/parkir1.jpeg" alt="" class="img rounded mx-auto d-block" style="object-fit: cover;">
                                    <div class="d-flex justify-content-between align-items-center pt-2">
                                        <h6 class="mb-1 text-dark text-sm">Jumlah Slot Tersedia</h6>
                                        <span class="text-sm font-weight-bold">430</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-2">
                                        <h6 class="mb-1 text-dark text-sm">Status</h6>
                                        <span class="text-sm font-weight-bold">Buka</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-2">
                                        <h6 class="mb-1 text-dark text-sm">Harga Parkir</h6>
                                        <span class="text-sm font-weight-bold">Rp.3000 /Jam</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-2 ">
                                        <a href="{{route('detail_lokasi')}}" class=" btn btn-warning btn-sm w-100 m-2">Detail</a>
                                        <a href="" class=" btn btn-success btn-sm w-100 m-2">Booking</a>
                                    </div>
                                </ul>
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
   $(document).ready(function () {
        // Initialize DataTable and assign it to a variable
        var table = $('#parkir').DataTable({
            searching: false, // Disable searching
            autoWidth: true,
            paging: false,
        });
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
