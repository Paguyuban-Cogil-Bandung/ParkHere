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
                                        <h6 class="mb-1 text-dark text-sm">Link Camera</h6>
                                        <span class="text-sm font-weight-bold">{{$place->url_stream}}</span>
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
                                        <button class="edit_place_btn btn btn-primary btn-sm w-100 m-2" data-id={{$place->place_id}}>Edit</button>
                                        <button class="delete_btn btn btn-danger btn-sm w-100 m-2" data-id={{$place->place_id}} data-name={{$place->name_place}}>Delete</button>
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
                            <input type="url" class="form-control" id="swal-input-url-stream">
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
                            <label for="add-place-usertype" class="form-label">Petugas 1</label>
                            <select id="swal-input-usertype-1" class="form-select" required>
                                <option value="" disabled>Select Petugas 1*</option>
                                @foreach ($users as $user)
                                <option value="{{ $user->id}}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="add-place-usertype" class="form-label">Petugas 2*</label>
                            <select id="swal-input-usertype-2" class="form-select" required>
                                <option value="" disabled>Select Petugas 2</option>
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
                    const petugas1 = document.getElementById('swal-input-usertype-1').value;
                    const petugas2 = document.getElementById('swal-input-usertype-2').value;
                    const petugas = [petugas1, petugas2].filter(Boolean);
                    console.log(petugas);

                    if (!name_place || !slot_tersedia || !jumlah_slot || !jumlah_booking || !lokasi || !url_stream || !harga_awal || !harga_per_jam || petugas.length < 2) {
                        Swal.showValidationMessage('Please fill in all fields');
                    }

                    // console.log(name_place, slot_tersedia, image, jumlah_slot, jumlah_booking, lokasi, url_stream, harga_awal, harga_per_jam, user_id);
                    // console.log(user_id);

                    return { name_place, slot_tersedia, image, jumlah_slot, jumlah_booking, lokasi, url_stream, harga_awal, harga_per_jam, petugas };
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
                    for (let i = 0; i < result.value.petugas.length; i++) {
                        formData.append('user_id[]', result.value.petugas[i]);
                    }

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
$(document).on('click', '.edit_place_btn', function () {
    const placeId = $(this).data('id'); 
    let url = `{{ route('kelola_parkir.find', ['id' => ':id']) }}`.replace(':id', placeId);
    // ID tempat parkir yang akan diedit
    $.ajax({
        url: url, // Endpoint untuk mendapatkan data tempat parkir
        type: 'GET',
        success: function (data) {
            console.log(data[0]);
            console.log(data[1]);
            Swal.fire({
                title: 'Edit Tempat Parkir',
                width: '1200px',
                html: `
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="mb-3">
                            <label class="form-label">Name Place*</label>
                            <input type="text" class="form-control" id="swal-input-name" value="${data[0].name_place}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slot Tersedia*</label>
                            <input type="number" class="form-control" id="swal-input-slot-tersedia" value="${data[0].slot_tersedia}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar Sampul*</label>
                            <input type="file" accept="image/*" class="form-control" id="swal-input-image">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jumlah Slot*</label>
                            <input type="number" class="form-control" id="swal-input-jumlah-slot" value="${data[0].jumlah_slot}" required>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="mb-3">
                            <label class="form-label">Jumlah Booking*</label>
                            <input type="number" class="form-control" id="swal-input-jumlah-booking" value="${data[0].jumlah_booking}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Lokasi*</label>
                            <input type="text" class="form-control" id="swal-input-lokasi" value="${data[0].lokasi}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">URL Stream</label>
                            <input type="url" class="form-control" id="swal-input-url-stream" value="${data[0].url_stream}">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="mb-3">
                            <label class="form-label">Harga Awal*</label>
                            <input type="number" class="form-control" id="swal-input-harga-awal" value="${data[0].harga_awal}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga Per Jam*</label>
                            <input type="number" class="form-control" id="swal-input-harga-per-jam" value="${data[0].harga_per_jam}" required>
                        </div>
                        @php
                            $sum = isset($data[1]['sum']) ? $data[1]['sum'] : 0;
                            
                        @endphp

                        @for ($i = $sum; $i < 2; $i++)
                            <div class="mb-3">
                                <label class="form-label">Petugas {{ $i + 1 }}*</label>
                                <select id="swal-input-usertype-{{ $i + 1 }}" class="form-select" required>
                                    <option value="" disabled>Select Petugas {{ $i + 1 }}</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" ${data[1][`{{$i}}`]['user_id'] == `{{$user->id}}` ? 'selected' : ''}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endfor
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
                    const petugas1 = document.getElementById('swal-input-usertype-1').value;
                    const petugas2 = document.getElementById('swal-input-usertype-2').value;

                    if (!name_place || !slot_tersedia || !jumlah_slot || !jumlah_booking || !lokasi || !harga_awal || !harga_per_jam || !petugas1 || !petugas2) {
                        Swal.showValidationMessage('Please fill in all required fields');
                        return false;
                    }

                    return {
                        name_place, slot_tersedia, image, jumlah_slot, jumlah_booking, lokasi, url_stream, harga_awal, harga_per_jam, petugas: [petugas1, petugas2]
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('name_place', result.value.name_place);
                    formData.append('slot_tersedia', result.value.slot_tersedia);
                    formData.append('image', result.value.image || ''); // Jika tidak diubah, gunakan nilai default
                    formData.append('jumlah_slot', result.value.jumlah_slot);
                    formData.append('jumlah_booking', result.value.jumlah_booking);
                    formData.append('lokasi', result.value.lokasi);
                    formData.append('url_stream', result.value.url_stream || '');
                    formData.append('harga_awal', result.value.harga_awal);
                    formData.append('harga_per_jam', result.value.harga_per_jam);
                    for (let i = 0; i < result.value.petugas.length; i++) {
                        formData.append('user_id[]', result.value.petugas[i]);
                    }

                    let url_update = `{{ route('kelola_parkir.edit', ['id' => ':id']) }}`.replace(':id', placeId);
                    $.ajax({
                        url: url_update, // Endpoint untuk update data
                        type: 'POST',
                        headers: { 'X-CSRF-TOKEN': '{{csrf_token()}}' },
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function (response) {
                            Swal.fire('Updated!', 'Parking place updated successfully.', 'success');
                            location.reload();
                        },
                        error: function (xhr) {
                            Swal.fire('Error!', 'There was an error updating the parking place.', 'error');
                        }
                    });
                }
            });
        },
        error: function () {
            Swal.fire('Error!', 'Failed to fetch parking place data.', 'error');
        }
    });
});


$(document).on('click', '.delete_btn', function (e) {
    e.preventDefault();
    const placeId = $(this).data('id');
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
            let url_delete = `{{ route('kelola_parkir.delete', ['id' => ':id']) }}`.replace(':id', placeId);
            $.ajax({
                url: url_delete, // Adjust the URL as needed
                type: 'DELETE',
                success: function (response) {
                    // Handle success response
                    Swal.fire(
                        'Dihapus!',
                        'Data berhasil dihapus.',
                        'success'
                    );
                    location.reload();
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
