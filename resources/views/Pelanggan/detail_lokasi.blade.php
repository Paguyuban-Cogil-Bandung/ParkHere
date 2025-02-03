@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])
<!-- Menu -->
@section('menu')
    @include('Pelanggan.menu')
@endsection

@section('title')
    Detail Lokasi
@endsection

<!-- content -->
@section('content')
    @include('layout.navbars.auth.topnav', ['title' => 'Detail Lokasi'])
    <div class="container-fluid py-0 pt-0 pb-0 mb-0">
        <div class="row pb-3">
            <div class="mb-xl-0">
                <div class="card">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <div class="d-flex justify-content-center align-items-center">
                            <h6 class="text-uppercase text-sm">{{ $data->name_place }}</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-uppercase text-sm">Pantauan</h6>
                        </div>
                    </div>
                    <div class="card-body pt-3">
                        <div class="video-container" style="overflow: hidden;">
                            <img src="https://hls-cam.ourproject.my.id/video_feed" class="w-100" alt="" id="video_feed">
                        <script>
                            setInterval(function() {
                                document.getElementById('video_feed').src = 'https://hls-cam.ourproject.my.id/video_feed?' + new Date().getTime();
                            }, 5000);
                        </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="mb-xl-0">
            <div class="card w-100">
                <!-- Card Header -->
                <div class="card-header pb-0 pt-3 bg-transparent d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase text-sm">Detail</h6>
                    <button id="booking_btn" class="btn btn-sm btn-warning">Booking Sekarang</button>
                </div>

                <!-- Card Body -->
                <div class="card-body pt-3">
                    <div class="row g-3">
                        <!-- Kolom Kiri -->
                        <div class="col-md-6">
                            <div class="bg-light rounded p-3 mb-3" style="min-height: 42px;">
                                <span class="fw-bold text-sm">Slot Parkir Tersedia</span>
                                <span class="text-sm float-end">{{ $data->slot_tersedia }}</span>
                            </div>
                            <div class="bg-light rounded p-3 mb-3" style="min-height: 42px;">
                                <span class="fw-bold text-sm">Harga Awal</span>
                                <span class="text-sm float-end">Rp.{{ $data->harga_awal }}</span>
                            </div>
                            <div class="bg-light rounded p-3 mb-3" style="min-height: 42px;">
                                <span class="fw-bold text-sm">Harga per Jam</span>
                                <span class="text-sm float-end">Rp.{{ $data->harga_per_jam }}</span>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-6">
                            <div class="bg-light rounded p-3 mb-3" style="min-height: 42px;">
                                <span class="fw-bold text-sm">Total Slot</span>
                                <span class="text-sm float-end">{{ $data->jumlah_slot }}</span>
                            </div>
                            <div class="bg-light rounded p-3 mb-3" style="min-height: 42px;">
                                <span class="fw-bold text-sm">Status Tempat Parkir</span>
                                <span class="text-sm float-end">{{ $data->status_place }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row pb-3 mt-4">
            <div class="mb-xl-0">
                <div class="card">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-uppercase text-sm">Lokasi</h6>
                            <div>
                                <a href="https://maps.app.goo.gl/dVgJuwjQDdB9jEax8" class="btn btn-sm btn-info">Lihat
                                    Lokasi</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-3">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.029660652463!2d107.61289967379024!3d-6.88705066738956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6f8aa08188b%3A0x632d24e6061e8903!2sUniversitas%20Komputer%20Indonesia%20(UNIKOM)!5e0!3m2!1sid!2sid!4v1736328214930!5m2!1sid!2sid"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layout.footers.auth.footer')
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (navigator.geolocation) {
                // Function to fetch and log location
                const fetchLocation = () => {
                    navigator.geolocation.getCurrentPosition(
                        (position) => {
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;

                            console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);
                        },
                        (error) => {
                            console.error('Error fetching location:', error.message);
                            alert('Unable to fetch location. Please allow location access.');
                        }
                    );
                };

                // Fetch location initially
                fetchLocation();

                // Set an interval to fetch location every 1 second (1000ms)
                setInterval(fetchLocation, 1000);
            } else {
                alert('Geolocation is not supported by your browser.');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).on('click', '#booking_btn', function() {
            const Booking_id = '{{ $data->place_id }}';
            const Booking_name = '{{ $data->name_place }}';
            const harga_awal = '{{ $data->harga_awal }}';
            const harga_per_jam = '{{ $data->harga_per_jam }}';
            const id_user = '{{ Auth::user()->id }}';
            const name_user = `{{ Auth::user()->name }}`;
            Swal.fire({
                title: 'Booking ' + Booking_name,
                html: `
                <div class="row">
                        <div class="mb-3">
                            <label for="add-place-name" class="form-label text-start">Plat Nomor*</label>
                            <input type="text" class="form-control" id="swal-input-no_plat" placeholder="X 1234 XX" required>
                        </div>
                </div>
                `,
                focusConfirm: false,
                showCancelButton: true,
                preConfirm: () => {
                    const no_plat = document.getElementById('swal-input-no_plat').value;
                    if (!no_plat) {
                        Swal.showValidationMessage('Masukkan Plat Nomor');
                        return false;
                    }
                    return {
                        no_plat
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('id_user', id_user);
                    formData.append('booking_id', Booking_id);
                    formData.append('name_user', name_user);
                    formData.append('no_plat', result.value.no_plat);
                    formData.append('name_place', Booking_name);
                    formData.append('harga_awal', harga_awal);
                    formData.append('harga_per_jam', harga_per_jam);

                    $.ajax({
                        url: '{{ route('parkir.booking') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Sertakan token CSRF di header
                        },
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(response) {
                            Swal.fire('Berhasil Booking!', 'Batas Booking 2 Jam', 'success');
                            location.reload();
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', 'Gagal Booking, Silahkan Coba Lagi.', 'error');
                        }
                    });
                }
            });
        });
    </script>
@endsection
