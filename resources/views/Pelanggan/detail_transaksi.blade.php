@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])
<!-- Menu -->
@section('menu')
    @include('Pelanggan.menu')
@endsection

@section('title')
    Detail Transaksi
@endsection

<!-- content -->
@section('content')
    @include('layout.navbars.auth.topnav', ['title' => 'Detail Transaksi'])
    <div class="container-fluid py-0 pt-0 pb-0 mb-0">
        <div class="row pb-3">
            <div class="mb-xl-0">
                <div class="card">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <div class="d-flex justify-content-center align-items-center">
                            <h6 class="text-uppercase text-sm">{{$data->name_place}}</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-uppercase text-sm">Pantauan</h6>
                        </div>
                    </div>
                    <div class="card-body pt-3">
                        {{-- <video id="my_video" class="video-js vjs-default-skin" controls>
                            <source src="rtsp://192.168.0.88/av0_0&user=admin&password=admin" type="application/x-mpegURL">
                          </video> --}}

                        {{-- <video id="test_video" controls autoplay>
                            <source src="rtsp://188.166.234.50:8001/av0_0&user=admin&password=admin">
                        </video> --}}


                        <video id="my_video" class="video-js vjs-default-skin w-100" controls preload="auto" autoplay>
                            <source src="http://188.166.234.50:8002" type="application/x-mpegURL">
                        </video>

                    </div>
                </div>
            </div>
        </div>

        <div class="row pb-3">
            <div class="mb-xl-0">
                <div class="card">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-uppercase text-sm">Detail</h6>
                            @if ($data->status_booking == 'Check In' AND $data->status_bayar == 'Belum Bayar')
                                <div>
                                    <button id="Bayar_btn" data-id="{{ $data->booking_id }}" class="btn btn-sm btn-warning m-1">Bayar</button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body pt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <span class="text-sm">ID Booking</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">{{$data->booking_id}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-sm">No Plat</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">Rp. {{$data->no_plat}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Durasi</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm" id="durasi-waktu">{{$data->durasi}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Tanggal Booking</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">{{$data->created_at}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Jam CheckIn</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">{{$data->jam_checkin}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Jam Checkout</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">{{$data->jam_checkout}}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Status Bayar</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">{{$data->status_bayar}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Harga Awal</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">{{$data->harga_awal}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Harga Per Jam</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">{{$data->harga_per_jam}}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Total Bayar</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm" id="total-bayar">{{$data->total_bayar}}</span>
                                        </td>
                                    </tr>
                                        <td>
                                            <span class="text-sm">Metode Bayar</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">{{$data->metode_bayar}}</span>
                                        </td>
                                    </tr>
                                    </tr>
                                        <td>
                                            <span class="text-sm">Jam Bayar</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">{{$data->jam_bayar}}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layout.footers.auth.footer')
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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
    <link href="https://vjs.zencdn.net/8.6.1/video-js.css" rel="stylesheet">

    <script src="https://vjs.zencdn.net/8.6.1/video.min.js"></script>
    <script>
        var player = videojs('my_video');
    </script>
    <script>
        $(document).ready(function () {
    // Ambil data dari Laravel (format YYYY-MM-DD HH:mm:ss)
    let checkinTime = "{{ $data->jam_checkin }}" ? new Date("{{ $data->jam_checkin }}").getTime() : null;
    let bayarTime = "{{ $data->jam_bayar }}" ? new Date("{{ $data->jam_bayar }}").getTime() : null;

    // Ambil harga awal & harga per jam dari Laravel
    let hargaAwal = parseInt("{{ $data->harga_awal }}") || 0;
    let hargaPerJam = parseInt("{{ $data->harga_per_jam }}") || 0;

    function updateDurationAndTotal() {
        let now = new Date().getTime(); // Ambil waktu saat ini

        // Jika belum check-in, tampilkan pesan dan hentikan proses
        if (!checkinTime) {
            $("#durasi-waktu").html("00:00:00");
            $("#total-bayar").html("-");
            return;
        }

        // Jika jam_bayar null, hitung sampai sekarang
        let duration = bayarTime ? (bayarTime - checkinTime) : (now - checkinTime);

        // Jika durasi negatif (check-in di masa depan), tampilkan pesan error
        if (duration < 0) {
            $("#durasi-waktu").html("Waktu Check-in Tidak Valid");
            $("#total-bayar").html("-");
            return;
        }

        // Konversi ke jam (dibulatkan ke atas)
        let totalJam = Math.ceil(duration / (1000 * 60 * 60));

        // Hitung total bayar
        let totalBayar = (hargaAwal - hargaPerJam) + (totalJam * hargaPerJam);

        // Format durasi ke jam:menit:detik
        let hours = Math.floor((duration / (1000 * 60 * 60)) % 24);
        let minutes = Math.floor((duration / (1000 * 60)) % 60);
        let seconds = Math.floor((duration / 1000) % 60);

        // Format angka menjadi 2 digit
        hours = String(hours).padStart(2, "0");
        minutes = String(minutes).padStart(2, "0");
        seconds = String(seconds).padStart(2, "0");

        // Tampilkan hasil
        if("{{ $data->durasi }}" == "" && "{{ $data->total_bayar }}" == ""){
            $("#durasi-waktu").html(`${hours}:${minutes}:${seconds}`);
            $("#total-bayar").html(`${totalBayar}`);
        }
    }

    // Jalankan update pertama kali
    updateDurationAndTotal();

    // Update setiap detik jika belum bayar
    if (!bayarTime) {
        setInterval(updateDurationAndTotal, 1000);
    }
});
    </script>
    <script>
        $(document).on('click', '#Bayar_btn', function() {
            const Booking_id = $(this).data('id');
            const durasi = document.getElementById('durasi-waktu').innerText;
            const total_bayar = document.getElementById('total-bayar').innerText;
            Swal.fire({
                title: 'Bayar Booking',
                html: `
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="add-place-name" class="form-label text-start">Harga Awal</label><br>
                            <span class="text-sm">Rp. {{$data->harga_awal}}</span><br>
                        </div>
                        <div class="mb-3">
                            <label for="add-place-name" class="form-label text-start">Plat Nomor</label><br>
                            <span class="text-sm" id="swal-input-durasi">${durasi}</span><br>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                                <label for="add-place-name" class="form-label text-start">Harga Per Jam</label><br>
                                <span class="text-sm">Rp. {{$data->harga_per_jam}}</span><br>
                            </div>
                        <div class="mb-3">
                            <label for="add-place-name" class="form-label text-start">Total Bayar</label><br>
                            <span class="text-sm text-success" id="swal-input-total-waktu">Rp. ${total_bayar}</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="add-place-name" class="form-label text-start">Metode Bayar*</label>
                        <select class="form-select" id="swal-input-metode-bayar" required>
                        <option value="" disabled>Pilih Plat Nomor</option>
                        <option value="transfer">Transfer</option>
                        <option value="dipetugas">Di Petugas</option>
                    </div>
                </div>
                `,
                focusConfirm: false,
                showCancelButton: true,
                preConfirm: () => {
                    const metode_bayar = document.getElementById('swal-input-metode-bayar').value;
                    
                    return {
                        metode_bayar
                    };
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('booking_id', Booking_id);
                    formData.append('durasi', durasi);
                    formData.append('total_bayar', total_bayar);
                    formData.append('metode_bayar', result.value.metode_bayar);

                    $.ajax({
                        url: '{{ route('parkir.booking.bayar') }}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Sertakan token CSRF di header
                        },
                        processData: false,
                        contentType: false,
                        data: formData,
                        success: function(response) {
                            Swal.fire('Berhasil Bayar!', 'Silahkan Ke Gerbang Keluar', 'success');
                            location.reload();
                        },
                        error: function(xhr) {
                            Swal.fire('Error!', 'Gagal Bayar, Silahkan Coba Lagi.', 'error');
                        }
                    });
                }
            });
        });
    </script>
@endsection
