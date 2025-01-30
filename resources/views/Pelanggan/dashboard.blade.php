@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])
<!-- Menu -->
@section('menu')
    @include('Pelanggan.menu')
@endsection

@section('title')
    Dashboard
@endsection

<!-- content -->
@section('content')
    @include('layout.navbars.auth.topnav', ['title' => 'Dashboard'])
    @if (!empty($booking))
        <div class="container-fluid pt-0 pb-0 mb-0">
            <div class="row w-100">
                <div class="mb-xl-0">
                    <div class="card">
                        <div class="row card-header pb-0 pl-0 pr-0 pt-3 w-100 bg-transparent" style="--bs-gutter-x: 0rem;">
                            <div class="col-6">
                                <h6 class="text-uppercase text-sm">Transaksi Aktif</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                @if ($booking->status_booking == 'Pending')
                                    <span
                                        class="text-sm bg-danger p-2 rounded text-white">{{ $booking->status_booking }}</span>
                                @elseif ($booking->status_booking == 'Check In')
                                    <span
                                        class="text-sm bg-success p-2 rounded text-white">{{ $booking->status_booking }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body pt-3">
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <table>
                                        <tr>
                                            <td>
                                                <span class="text-sm">No. Booking</span>
                                                <span class="text-sm">:</span>
                                                <span class="text-sm">{{ $booking->booking_id }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="text-sm">Plat Nomor</span>
                                                <span class="text-sm">:</span>
                                                <span class="text-sm">{{ $booking->no_plat }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-6 col-md-12 d-flex justify-content-between justify-content-lg-end">
                                    <table>
                                        <tr>
                                            <td>
                                                <span class="text-sm">Waktu Checkin</span>
                                                <span class="text-sm">:</span>
                                                <span class="text-sm">{{ $booking->jam_checkin }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <span class="text-sm">Total Waktu</span>
                                                <span class="text-sm">:</span>
                                                <span class="text-sm" id="durasi-waktu">{{ $booking->durasi }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pt-0">
                            <div class="row" style="--bs-gutter-x: 0rem;">
                                <div class="col-lg-6 col-md-12 mb-2">
                                    {{-- <span><span class="text-sm">Total Harga :</span> <b class="text-xl">{{$booking->total_bayar}}</b></span><br> --}}
                                </div>
                                <div class="col-lg-6 col-md-12 d-flex justify-content-center mr-4 justify-content-lg-end">
                                    <span><span class="text-sm">Expire Tme :</span> <b class="text-xl"
                                            id="countdown-timer">-</b></span><br>
                                </div>
                            </div>
                            <div class="row" style="--bs-gutter-x: 0rem;">
                                <div class="col-lg-6 col-md-12 mb-2">
                                    <span><span class="text-sm">Total Harga :</span> <b
                                            class="text-xl" id="total-bayar">{{ $booking->total_bayar }}</b></span><br>
                                </div>
                                <div class="col-lg-6 col-md-12 d-flex justify-content-center justify-content-lg-end">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ url('detail_transaksi/' . $booking->booking_id) }}"
                                            class="btn btn-sm btn-info m-1">Detail</a>
                                        @if ($booking->status_bayar == 'Belum Bayar' && $booking->status_booking != 'Pending')
                                            <a href="" class="btn btn-sm btn-warning m-1">Bayar</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid py-0 pt-4 pb-0 mb-0">
        <div id="parking-list" class="row">
            <!-- Data parkir akan ditampilkan disini -->
        </div>
        @include('layout.footers.auth.footer')
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/geolib@3.3.4/lib/index.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Memeriksa apakah browser mendukung geolocation
            if (!navigator.geolocation) {
                console.error("Geolocation tidak didukung oleh browser ini.");
                document.getElementById("parking-list").innerHTML =
                    `<p class="text-center text-danger">Browser tidak mendukung geolocation.</p>`;
                return;
            }

            // Mendapatkan lokasi pengguna
            navigator.geolocation.getCurrentPosition(position => {
                const userLatitude = position.coords.latitude;
                const userLongitude = position.coords.longitude;

                console.log("Lokasi pengguna:", userLatitude, userLongitude);


                // Mengambil data lokasi parkir dari server
                fetch("{{ route('kelola_parkir.location') }}", {
                        method: "GET",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        mode: "cors"
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Periksa apakah data parkir valid
                        if (!Array.isArray(data) || data.length === 0) {
                            document.getElementById("parking-list").innerHTML =
                                `<p class="text-center">Tidak ada data tempat parkir.</p>`;
                            return;
                        }

                        // Hitung jarak antara pengguna dan tempat parkir
                        data.forEach(location => {
                            if (location.latitude && location.longitude) {
                                const lat1 = userLatitude;
                                const lon1 = userLongitude;
                                const lat2 = location.latitude;
                                const lon2 = location.longitude;
                                const distance = geolib.getDistance({
                                    latitude: lat1,
                                    longitude: lon1
                                }, {
                                    latitude: lat2,
                                    longitude: lon2
                                });
                                location.distance = distance / 1000; // Convert to kilometers
                            } else {
                                location.distance =
                                null; // Tentukan jarak sebagai null jika data lokasi tidak valid
                            }
                        });

                        // Urutkan lokasi berdasarkan jarak terdekat
                        data.sort((a, b) => (a.distance !== null ? a.distance : Infinity) - (b
                            .distance !== null ? b.distance : Infinity));

                        // Tampilkan hasil
                        const parkingList = document.getElementById("parking-list");
                        parkingList.innerHTML = ""; // Kosongkan daftar parkir terlebih dahulu

                        // Jika tidak ada tempat parkir yang ditemukan dalam radius
                        if (data.length === 0 || data.every(location => location.distance === null)) {
                            parkingList.innerHTML =
                                `<p class="text-center">Tidak ada tempat parkir terdekat yang ditemukan.</p>`;
                            return;
                        }

                        // Looping data lokasi parkir dan tampilkan dalam bentuk kartu
                        data.forEach(location => {
                            if (location.distance !== null) {
                                let bookingSection = "";

                                if (location.status_place === "Buka") {
                                    bookingSection = `
                                        <div class="d-flex justify-content-between align-items-center pt-2">
                                            <a href="{{ url('detail_lokasi/' . '${location.place_id}') }}" class="btn btn-warning btn-sm w-100 m-2">Detail</a>
                                            <button id="Booking_btn" data-id="${location.place_id}" data-harga_awal="${location.harga_awal}" 
                                                data-harga_per_jam="${location.harga_per_jam}" data-booking_name="${location.name_place}" 
                                                class="booking_btn btn btn-success btn-sm w-100 m-2">Booking</button>
                                        </div>`;
                                } else {
                                    bookingSection = `
                                        <div class="d-flex justify-content-between align-items-center pt-2">
                                            <a href="{{ url('detail_lokasi/' . '${location.place_id}') }}" class="btn btn-warning btn-sm w-100 m-2">Detail</a>
                                        </div>`;
                                }
                                const card = `
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-header pb-0 p-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6 class="mb-0">${location.name_place}</h6>
                                            <span class="mb-0">${location.distance.toFixed(1)} KM</span>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <ul class="list-group">
                                            <img src="{{ asset('storage/' . '${location.image}') }}" alt="Tempat Parkir" class="img rounded mx-auto d-block" style="object-fit: cover; max-width: 100%;">
                                            <div class="d-flex justify-content-between align-items-center pt-2">
                                                <h6 class="mb-1 text-dark text-sm">Jumlah Slot Tersedia</h6>
                                                <span class="text-sm font-weight-bold">${location.slot_tersedia}</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center pt-2">
                                                <h6 class="mb-1 text-dark text-sm">Status</h6>
                                                <span class="text-sm font-weight-bold ${location.status_place === "Buka" ? 'text-success' : 'text-danger'}">
                                                    ${location.status_place}
                                                </span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center pt-2">
                                                <h6 class="mb-1 text-dark text-sm">Harga Parkir</h6>
                                                <span class="text-sm font-weight-bold">Rp.${location.harga_awal} /Jam</span>
                                            </div>
                                            ${bookingSection}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        `;
                                parkingList.innerHTML += card;
                            }
                        });
                    })
                    .catch(error => {
                        console.error("Error fetching data:", error);
                        document.getElementById("parking-list").innerHTML =
                            `<p class="text-center text-danger">Gagal mengambil data parkir.</p>`;
                    });

            }, error => {
                console.error("Geolocation Error:", error.message);
                document.getElementById("parking-list").innerHTML =
                    `<p class="text-center text-danger">Tidak dapat mengakses lokasi Anda.</p>`;
            });

            // Fungsi Haversine untuk menghitung jarak antara dua titik koordinat
            function haversineDistance(lat1, lon1, lat2, lon2) {
                const R = 6371; // Radius bumi dalam kilometer
                const φ1 = lat1 * Math.PI / 180;
                const φ2 = lat2 * Math.PI / 180;
                const Δφ = (lat2 - lat1) * Math.PI / 180;
                const Δλ = (lon2 - lon1) * Math.PI / 180;

                const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) + Math.cos(φ1) * Math.cos(φ2) * Math.sin(Δλ / 2) *
                    Math.sin(Δλ / 2);
                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

                return R * c; // Convert to kilometers
            }

        });
    </script>
    <script>
        $(document).on('click', '#Booking_btn', function() {
            const Booking_id = $(this).data('id');
            const Booking_name = $(this).data('booking_name');
            const harga_awal = $(this).data('harga_awal');
            const harga_per_jam = $(this).data('harga_per_jam');
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
    <script>
        $(document).ready(function() {
    // Ambil status booking dari Laravel
    let statusBooking = "{{ $booking != null ? $booking->status_booking : '' }}";

    // Jika status sudah checkin atau checkout, hentikan timer
    if (statusBooking === "Check In" || statusBooking === "Check Out") {
        $("#countdown-timer").html("-");
        return;
    }

    // Ambil waktu booking dari Laravel (format UTC)
    let createdAt = "{{ $booking != null ? $booking->created_at : '' }}";
    
    if (!createdAt) {
        $("#countdown-timer").html("Booking Tidak Ditemukan");
        return;
    }

    let createdAtTime = new Date(createdAt).getTime();
    
    // Hitung batas akhir (2 jam setelah created_at)
    let expirationTime = createdAtTime + (2 * 60 * 60 * 1000); // 2 jam dalam milidetik

    // Update countdown setiap detik
    let countdownInterval = setInterval(function() {
        let now = new Date().getTime();
        let remainingTime = expirationTime - now;

        // Jika waktu habis, tampilkan alert & update status ke Cancelled
        if (remainingTime <= 0) {
            clearInterval(countdownInterval);
            $("#countdown-timer").html("Waktu Booking Habis!");

            $.ajax({
                url: '{{ route('parkir.booking.update') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    booking_id: '{{ $booking != null ? $booking->booking_id : '' }}',
                    status_booking: 'Cancelled'
                },
                success: function(response) {
                    if (response.error) {
                        console.error('Gagal update status booking:', response.error);
                        return;
                    }
                    Swal.fire({
                        title: 'Waktu Habis!',
                        text: 'Booking Anda telah dibatalkan.',
                        icon: 'error'
                    }).then(() => {
                        window.location.reload();
                    });
                },
                error: function(xhr) {
                    console.error('Gagal update status booking');
                }
            });

            return;
        }

        // Konversi ke jam, menit, detik
        let hours = Math.floor((remainingTime / (1000 * 60 * 60)) % 24);
        let minutes = Math.floor((remainingTime / (1000 * 60)) % 60);
        let seconds = Math.floor((remainingTime / 1000) % 60);

        // Format angka menjadi 2 digit (misal: 09:05:03)
        hours = String(hours).padStart(2, "0");
        minutes = String(minutes).padStart(2, "0");
        seconds = String(seconds).padStart(2, "0");

        // Tampilkan di HTML
        $("#countdown-timer").html(`${hours}:${minutes}:${seconds}`);

    }, 1000);
});

    </script>
<script>
    $(document).ready(function () {
// Ambil data dari Laravel (format YYYY-MM-DD HH:mm:ss)
    let checkinTime = "{{ $booking ? $booking->jam_checkin : '' }}" ? new Date("{{ $booking ? $booking->jam_checkin : '' }}").getTime() : null;
    let bayarTime = "{{ $booking ? $booking->jam_bayar : '' }}" ? new Date("{{ $booking ? $booking->jam_bayar : '' }}").getTime() : null;

    // Ambil harga awal & harga per jam dari Laravel
    let hargaAwal = parseInt("{{ $booking ? $booking->harga_awal : 0 }}") || 0;
    let hargaPerJam = parseInt("{{ $booking ? $booking->harga_per_jam : 0 }}") || 0;

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
        let totalBayar = hargaAwal + (totalJam * hargaPerJam);

        // Format durasi ke jam:menit:detik
        let hours = Math.floor((duration / (1000 * 60 * 60)) % 24);
        let minutes = Math.floor((duration / (1000 * 60)) % 60);
        let seconds = Math.floor((duration / 1000) % 60);

        // Format angka menjadi 2 digit
        hours = String(hours).padStart(2, "0");
        minutes = String(minutes).padStart(2, "0");
        seconds = String(seconds).padStart(2, "0");

        // Tampilkan hasil
        $("#durasi-waktu").html(`${hours}:${minutes}:${seconds}`);
        $("#total-bayar").html(`${totalBayar.toLocaleString("id-ID")}`);
    }

    // Jalankan update pertama kali
    updateDurationAndTotal();

    // Update setiap detik jika belum bayar
    if (!bayarTime) {
        setInterval(updateDurationAndTotal, 1000);
    }
    });

</script>
@endsection
