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
                <div class="card">
                    <div class="d-flex justify-content-between align-items-center pt-2 pb-1 ml-4 mr-4 m-2">
                        <h6 class="">Kelola Tempat Parkir</h6>
                        <button id="add_place_btn" class="btn btn-secondary btn-sm">Tambah Tempat Parkir</button>
                    </div>
                </div>
            {{-- </div> --}}
        </div>
        <div class="container-fluid">
            <div class="row">
                @foreach ($places as $place)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">{{$place->name_place}}</h6>
                                <h6 class="mb-0">{{$place->status_place}}</h6>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group ">
                                <img src="{{ asset('images/' . $place->image) }}" alt="" class="img rounded mx-auto d-block" style="object-fit: cover;">
                                    <div class="d-flex justify-content-between align-items-center pt-2">
                                        <h6 class="mb-1 text-dark text-sm">Slot Tersedia</h6>
                                        <span class="text-sm font-weight-bold">{{$place->slot_tersedia}}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-2">
                                        <h6 class="mb-1 text-dark text-sm">Total Slot</h6>
                                        <span class="text-sm font-weight-bold">{{$place->jumlah_slot}}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-2">
                                        <h6 class="mb-1 text-dark text-sm">Jumlah Booking</h6>
                                        <span class="text-sm font-weight-bold">{{$place->jumlah_booking}}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-2">
                                        <h6 class="mb-1 text-dark text-sm">Lokasi</h6>
                                        <span class="text-sm font-weight-bold">{{$place->lokasi}}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-2">
                                        <h6 class="mb-1 text-dark text-sm">Harga Awal</h6>
                                        <span class="text-sm font-weight-bold">Rp.{{$place->harga_awal}}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-2">
                                        <h6 class="mb-1 text-dark text-sm">Harga Perjam</h6>
                                        <span class="text-sm font-weight-bold">Rp.{{$place->harga_per_jam}}</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-2">
                                        <h6 class="mb-1 text-dark text-sm">Petugas</h6>
                                        <div>
                                            @foreach ($place->listPetugas as $petugas)
                                                <span class="text-sm font-weight-bold">{{$petugas->user->name}}</span><br>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center pt-2 ">
                                        <a href="{{route('detail_lokasi')}}" class=" btn btn-primary btn-sm w-100 m-2">Ubah</a>
                                        <a href="" class=" btn btn-danger btn-sm w-100 m-2">Delete</a>
                                    </div>
                                </ul>
                            </div>
                    </div>
                </div>
                @endforeach
            </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
   $(document).ready(function () {
        // Initialize DataTable and assign it to a variable
        var table = $('#parkir').DataTable({
            searching: false, // Disable searching
            autoWidth: true,
            paging: false,
        });
   });
        $('#add_place_btn').on('click', function () {
            Swal.fire({
                title: 'Tambah Tempat Parkir',
                width: '1200px',
                html: `
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="mb-3">
                            <label for="add-place-name" class="form-label text-start">Name Place*</label>
                            <input type="text" class="form-control" id="swal-input-name" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-place-slot-tersedia" class="form-label">Slot Tersedia *</label>
                            <input type="number" class="form-control" id="swal-input-slot-tersedia" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-place-image" class="form-label">Gambar Sampul*</label>
                            <input type="file" accept="image/*" class="form-control" id="swal-input-image" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-place-jumlah-slot" class="form-label">Jumlah Slot*</label>
                            <input type="number" class="form-control" id="swal-input-jumlah-slot" required>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="mb-3">
                            <label for="add-place-jumlah-booking" class="form-label text-start">Jumlah Booking*</label>
                            <input type="number" class="form-control" id="swal-input-jumlah-booking" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-place-lokasi" class="form-label">Lokasi*</label>
                            <input type="text" class="form-control" id="swal-input-lokasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-place-url-stream" class="form-label">URL Stream*</label>
                            <input type="text" class="form-control" id="swal-input-url-stream">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="mb-3">
                            <label for="add-place-harga-awal" class="form-label">Harga Awal*</label>
                            <input type="number" class="form-control" id="swal-input-harga-awal">
                        </div>
                        <div class="mb-3">
                            <label for="add-place-harga-per-jam" class="form-label text-start">Harga Per Jam</label>
                            <input type="number" class="form-control" id="swal-input-harga-per-jam" required>
                        </div>
                        <div class="mb-3">
                            <label for="add-place-usertype" class="form-label">User Type</label>
                            <select id="swal-input-usertype" class="form-select" required>
                                <option value="" disabled>Select User Type</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id}}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                `,
                focusConfirm: false,
                showCancelButton: true,
                preConfirm: () => {
                    const name_place = document.getElementById('swal-input-name').value;
                    const slot_tersedia = document.getElementById('swal-input-slot-tersedia').value;
                    const image = document.getElementById('swal-input-image').files[0];
                    const jumlah_slot = document.getElementById('swal-input-jumlah-slot').value;
                    const jumlah_booking = document.getElementById('swal-input-jumlah-booking').value;
                    const lokasi = document.getElementById('swal-input-lokasi').value;
                    const url_stream = document.getElementById('swal-input-url-stream').value;
                    const harga_awal = document.getElementById('swal-input-harga-awal').value;
                    const harga_per_jam = document.getElementById('swal-input-harga-per-jam').value;
                    const user_id = document.getElementById('swal-input-usertype').value;

                    if (!name_place || !slot_tersedia || !jumlah_slot || !jumlah_booking || !lokasi || !url_stream || !harga_awal || !harga_per_jam || !user_id) {
                        Swal.showValidationMessage('Please fill in all fields');
                    }

                    // console.log(name_place, slot_tersedia, image, jumlah_slot, jumlah_booking, lokasi, url_stream, harga_awal, harga_per_jam, user_id);
                    // console.log(user_id);

                    return { name_place, slot_tersedia, image, jumlah_slot, jumlah_booking, lokasi, url_stream, harga_awal, harga_per_jam, user_id };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('name_place', result.value.name_place);
                    formData.append('slot_tersedia', result.value.slot_tersedia);
                    formData.append('image', result.value.image);
                    formData.append('jumlah_slot', result.value.jumlah_slot);
                    formData.append('jumlah_booking', result.value.jumlah_booking);
                    formData.append('lokasi', result.value.lokasi);
                    formData.append('url_stream', result.value.url_stream);
                    formData.append('harga_awal', result.value.harga_awal);
                    formData.append('harga_per_jam', result.value.harga_per_jam);
                    formData.append('user_id', result.value.user_id);

                    $.ajax({
                        url: '{{ route('kelola_parkir.add') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}' // Sertakan token CSRF di header
                        },
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function (response) {
                            Swal.fire('Added!', 'New parking place has been added.', 'success');
                            location.reload();
                        },
                        error: function (xhr) {
                            Swal.fire('Error!', 'There was an error adding the parking place.', 'error');
                        }
                    });
                }
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
