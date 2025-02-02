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
    {{-- {{dd($parking_places)}} --}}
    @include('layout.navbars.auth.topnav', ['title' => 'Dashboard'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <div class="container-fluid py-0 pt-0 pb-0">
        <div class="row">
            <div class="mb-xl-0">
                <div class="card">
                    <span class="text-sm px-2 py-2"><i class="fa fa-location-dot"></i> Lokasi Penugasan :
                        <b>{{ $parking_places[0]['name_place'] }}</b></span>

                </div>
            </div>
        </div>
    </div>
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
                                        {{ $jumlah_slot_tersedia }}
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
                                        {{ $jumlah_booking_pending }}
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
                                        {{ $jumlah_slot_terisi }}
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
                                        {{ $total_transaksi_today }}
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

        <div class="row mt-0">
            <div class="col-lg-8 mt-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Pantauan</h6>
                    </div>
                    <div class="card-body p-3">
                        <video id="my_video" class="video-js vjs-default-skin w-100" controls preload="auto" autoplay style="height: 25em;">
                            <source src="https://hls-cam.ourproject.my.id" type="application/x-mpegURL">
                        </video>
                        {{-- <iframe width="100%" height="515" src="https://www.youtube.com/embed/xpgiCNO1uAA?si=NSzZG5VJBHuSzkep" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope;" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2"><i class="fa fa-cog"></i> Pengaturan Cabang
                                {{ $parking_places[0]['name_place'] }}</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <span for="" clas>Status : </span>
                            </div>
                            <div class="col-10">
                                <select class="form-select" name="status" data-id="{{ $parking_places[0]['place_id'] }}"
                                    id="status">
                                    <option value="Buka"
                                        {{ $parking_places[0]['status_place'] == 'Buka' ? 'selected' : '' }}> Buka </option>
                                    <option value="Tutup"
                                        {{ $parking_places[0]['status_place'] == 'Tutup' ? 'selected' : '' }}> Tutup
                                    </option>
                                    <option value="Penuh"
                                        {{ $parking_places[0]['status_place'] == 'Penuh' ? 'selected' : '' }}> Penuh
                                    </option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="w-100 text-center"><span for="" clas>Darurat Check In: </span></div>
                                <div class="w-100">
                                    <button id="buka_emergency_in" class="btn btn-success">Tombol Buka</button>
                                    <button id="tutup_emergency_in" class="btn btn-danger">Tombol Tutup</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <div class="w-100 text-center"><span for="" clas>Darurat Check Out: </span></div>
                                <div class="w-100">
                                    <button id="buka_emergency_co" class="btn btn-success">Tombol Buka</button>
                                    <button id="tutup_emergency_co" class="btn btn-danger">Tombol Tutup</button>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <span>Update Foto</span>
                            </div>
                            <div class="col-10">
                                <input type="file" id="fileInput" class="form-input">
                                <button id="updateButton" data-id="{{ $parking_places[0]['place_id'] }}"
                                    class="btn btn-primary">Update</button>
                            </div>
                            <img src="{{ asset('storage/' . $parking_places[0]['image']) }}" class="rounded pt-2"
                                alt="">
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-2">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Daftar Transaksi</h6>
                        </div>
                    </div>
                    <div class="table-responsive ps-4 pe-4">
                        <table id="booking" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>ID Booking</th>
                                    <th>Nama User</th>
                                    <th>No Plat</th>
                                    <th>Total Jam Parkir</th>
                                    <th>Total Bayar</th>
                                    <th>Status Booking</th>
                                    <th>Status Bayar</th>
                                    <th>Jam Checkin</th>
                                    <th>Jam Bayar</th>
                                    <th>Jam Checkout</th>
                                    <th>Total Bayar</th>
                                    <th>Metode Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $booking['booking_id'] }}</td>
                                        <td>{{ $booking['name_user'] }}</td>
                                        <td>{{ $booking['no_plat'] }}</td>
                                        <td>{{ $booking['durasi'] }}</td>
                                        <td>{{ $booking['total_bayar'] }}</td>
                                        <td>{{ $booking['status_booking'] }}</td>
                                        <td>{{ $booking['status_bayar'] }}</td>
                                        <td>{{ $booking['jam_checkin'] }}</td>
                                        <td>{{ $booking['jam_bayar'] }}</td>
                                        <td>{{ $booking['jam_checkout'] }}</td>
                                        <td>{{ $booking['total_bayar'] }}</td>
                                        <td>{{ $booking['metode_bayar'] }}</td>
                                        {{-- <td><button class="delete-btn btn btn-danger btn-sm" data-id="${data.id}" data-name="${data.name}">Delete <i class="fe fe-delete"></i></button>
                                        <button class="delete-btn btn btn-danger btn-sm" data-id="${data.id}" data-name="${data.name}">Delete <i class="fe fe-delete"></i></button>
                                    </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layout.footers.auth.footer')
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function handleEmergency(buttonId, action, device, state) {
                document.getElementById(buttonId).addEventListener("click", function() {
                    fetch(
                            `https://parkhere-backend.ourproject.my.id/mqtt?topic=parking/action&message={"type":"action","device":"${device}","state":${state}}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.result_code == 0) {
                                Swal.fire("Berhasil!", "Aksi telah dilakukan.", "success");
                            } else {
                                Swal.fire("Gagal!", "Terjadi kesalahan.", "error");
                            }
                        })
                });
            }

            handleEmergency("buka_emergency_in", "buka", "SRV1", 1);
            handleEmergency("tutup_emergency_in", "tutup", "SRV1", 0);
            handleEmergency("buka_emergency_co", "buka", "SRV2", 1);
            handleEmergency("tutup_emergency_co", "tutup", "SRV2", 0);
        });
    </script>
    <script>
        new DataTable('#booking', {

        });
        document.getElementById('status').addEventListener('change', function() {
            const select = this;
            const placeId = select.getAttribute('data-id'); // Ambil ID tempat parkir
            const newStatus = select.value; // Ambil nilai baru

            // URL endpoint untuk update status
            const url_update = `{{ route('toggleStatus', ['id' => ':id']) }}`.replace(':id', placeId);

            // Data yang akan dikirim ke server
            const data = {
                status: newStatus, // Status baru
                id: placeId // ID tempat parkir
            };

            // Kirim request ke server dengan jQuery AJAX
            $.ajax({
                url: url_update,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Sertakan token CSRF di header
                },
                data: JSON.stringify(data), // Kirim data sebagai JSON
                contentType: 'application/json', // Tentukan tipe konten sebagai JSON
                success: function(response) {
                    Swal.fire('Berhasil!', 'Status parkir berhasil diperbarui.', 'success');
                    location.reload(); // Reload halaman jika sukses
                },
                error: function(xhr) {
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat memperbarui status parkir.', 'error');
                }
            });
        });

        document.getElementById('updateButton').addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah refresh halaman

            const fileInput = document.getElementById('fileInput');

            const file = fileInput.files[0]; // Ambil file yang diunggah
            const formData = new FormData();
            const placeId = $(this).data('id');
            if (!file) {
                Swal.fire('Error!', 'Silakan pilih file terlebih dahulu.', 'error');
                return;
            }

            // Tambahkan file ke FormData
            formData.append('image', file);

            // Tambahkan CSRF token untuk keamanan
            formData.append('_token', '{{ csrf_token() }}');

            // Kirim request AJAX ke server
            let url_update = `{{ route('updateParkingImage', ['id' => ':id']) }}`.replace(':id', placeId);
            $.ajax({
                url: url_update,
                type: 'POST',
                data: formData,
                processData: false, // Jangan proses data menjadi string
                contentType: false, // Jangan tetapkan header Content-Type secara manual
                success: function(response) {
                    Swal.fire('Berhasil!', 'Foto berhasil diperbarui.', 'success');
                    location.reload(); // Reload halaman jika sukses
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'Terjadi kesalahan saat memperbarui foto.', 'error');
                }
            });
        });

        // Event delegation for dynamically created buttons
        $('#users').on('click', '.update-btn', function(e) {
            e.preventDefault();
            const userId = $(this).data('id');

            // Fetch user data from the API
            $.ajax({
                url: `https://parkhere-backend.ourproject.my.id/user/${userId}`, // Adjust the URL as needed
                type: 'GET',
                success: function(user) {
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
                            const usertype = document.getElementById('swal-input-usertype')
                                .value;

                            // Validate inputs
                            if (!name || !email || !usertype) {
                                Swal.showValidationMessage('Please fill in all fields');
                            }

                            return {
                                name,
                                email,
                                usertype
                            };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Send updated data to the API
                            $.ajax({
                                url: `https://parkhere-backend.ourproject.my.id/user/update/${userId}`, // Adjust the URL as needed
                                type: 'PUT',
                                contentType: 'application/json',
                                data: JSON.stringify(result.value),
                                success: function(response) {
                                    Swal.fire(
                                        'Updated!',
                                        'User  details have been updated.',
                                        'success'
                                    );
                                    // Reload the DataTable
                                    $('#users').DataTable().ajax.reload();
                                },
                                error: function(xhr, status, error) {
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
                error: function(xhr, status, error) {
                    Swal.fire(
                        'Error!',
                        'Could not fetch user data.',
                        'error'
                    );
                }
            });
        });

        $('#users').on('click', '.delete-btn', function(e) {
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
                        success: function(response) {
                            // Handle success response
                            Swal.fire(
                                'Dihapus!',
                                'Data berhasil dihapus.',
                                'success'
                            );
                            // Reload the DataTable
                            $('#users').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
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
    <link href="https://vjs.zencdn.net/8.6.1/video-js.css" rel="stylesheet">
    <script src="https://vjs.zencdn.net/8.6.1/video.min.js"></script>
    <script>
        var player = videojs('my_video');
    </script>
@endsection
