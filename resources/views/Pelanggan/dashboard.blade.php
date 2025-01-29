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
    <div class="container-fluid pt-0 pb-0 mb-0">
        <div class="row w-100">
            <div class="mb-xl-0">
                <div class="card">
                    <div class="row card-header pb-0 pl-0 pr-0 pt-3 w-100 bg-transparent" style="--bs-gutter-x: 0rem;">
                        <div class="col-6">
                            <h6 class="text-uppercase text-sm">Transaksi Aktif</h6>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <span class="text-sm bg-danger p-2 rounded text-white">Pending</span>
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
                                            <span class="text-sm">12091212</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Plat Nomor</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">F 1233 XK</span>
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
                                            <span class="text-sm">{{ date('H:i:s') }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Total Waktu</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">12 Jam</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer pt-0">
                        <div class="row" style="--bs-gutter-x: 0rem;">
                            <div class="col-lg-6 col-md-12 mb-2">
                                <span><span class="text-sm">Total Harga :</span> <b class="text-xl">Rp.200.000</b></span><br>
                            </div>
                            <div class="col-lg-6 col-md-12 d-flex justify-content-center justify-content-lg-end">
                                <div class="d-flex justify-content-center">
                                    <a href="{{url('detail_transaksi')}}" class="btn btn-sm btn-info m-1">Detail</a>
                                    <a href="" class="btn btn-sm btn-warning m-1">Bayar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-0 pt-4 pb-0 mb-0">
        <div class="row pb-3">
            <div class="mb-xl-0">
                <div class="card">
                    <div class="card-header w-100">
                        <h6 class="text-uppercase   text-sm">Cari Lokasi Parkir</h6>
                        <form action="" method="get" class="w-100">
                            <div class="row w-100">                            
                                <div class="col-lg-11 col-sm-11">
                                    <input type="text" class="form-control m-1" placeholder="Cari Lokasi Parkir"> 
                                </div>
                                <div class="col-lg-1 col-sm-1">
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-primary m-1 text-sm btn-sm">Cari</button> 
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div id="parking-list" class="row">
            <!-- Data parkir akan ditampilkan disini -->
        </div>
        <div class="d-flex justify-content-center">
            <button class="btn btn-outline-primary btn-sm">Tampilkan Lebih Banyak</button>
        </div>
        @include('layout.footers.auth.footer')
    </div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/geolib@3.3.4/lib/index.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Memeriksa apakah browser mendukung geolocation
        if (!navigator.geolocation) {
            console.error("Geolocation tidak didukung oleh browser ini.");
            document.getElementById("parking-list").innerHTML = `<p class="text-center text-danger">Browser tidak mendukung geolocation.</p>`;
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
                    document.getElementById("parking-list").innerHTML = `<p class="text-center">Tidak ada data tempat parkir.</p>`;
                    return;
                }

                // Hitung jarak antara pengguna dan tempat parkir
                data.forEach(location => {
                    if (location.latitude && location.longitude) {
                        const lat1 = userLatitude;
                        const lon1 = userLongitude;
                        const lat2 = location.latitude;
                        const lon2 = location.longitude;
                        const distance = geolib.getDistance(
                            { latitude: lat1, longitude: lon1 },
                            { latitude: lat2, longitude: lon2 }
                        );
                        location.distance = distance / 1000; // Convert to kilometers
                    } else {
                        location.distance = null; // Tentukan jarak sebagai null jika data lokasi tidak valid
                    }
                });

                // Urutkan lokasi berdasarkan jarak terdekat
                data.sort((a, b) => (a.distance !== null ? a.distance : Infinity) - (b.distance !== null ? b.distance : Infinity));

                // Tampilkan hasil
                const parkingList = document.getElementById("parking-list");
                parkingList.innerHTML = ""; // Kosongkan daftar parkir terlebih dahulu

                // Jika tidak ada tempat parkir yang ditemukan dalam radius
                if (data.length === 0 || data.every(location => location.distance === null)) {
                    parkingList.innerHTML = `<p class="text-center">Tidak ada tempat parkir terdekat yang ditemukan.</p>`;
                    return;
                }

                // Looping data lokasi parkir dan tampilkan dalam bentuk kartu
                data.forEach(location => {
                    if (location.distance !== null) {
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
                                            <img src="{{ asset('/assets') }}/guest/images/parkir1.jpeg" alt="Tempat Parkir" class="img rounded mx-auto d-block" style="object-fit: cover; max-width: 100%;">
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
                                            <div class="d-flex justify-content-between align-items-center pt-2">
                                                
                                                <a href="{{ url('detail_lokasi/'.'${location.place_id}') }}" class="btn btn-warning btn-sm w-100 m-2">Detail</a>
                                                <a href="#" class="btn btn-success btn-sm w-100 m-2">Booking</a>
                                            </div>
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
                document.getElementById("parking-list").innerHTML = `<p class="text-center text-danger">Gagal mengambil data parkir.</p>`;
            });

        }, error => {
            console.error("Geolocation Error:", error.message);
            document.getElementById("parking-list").innerHTML = `<p class="text-center text-danger">Tidak dapat mengakses lokasi Anda.</p>`;
        });

        // Fungsi Haversine untuk menghitung jarak antara dua titik koordinat
        function haversineDistance(lat1, lon1, lat2, lon2) {
            const R = 6371; // Radius bumi dalam kilometer
            const φ1 = lat1 * Math.PI / 180;
            const φ2 = lat2 * Math.PI / 180;
            const Δφ = (lat2 - lat1) * Math.PI / 180;
            const Δλ = (lon2 - lon1) * Math.PI / 180;

            const a = Math.sin(Δφ / 2) * Math.sin(Δφ / 2) + Math.cos(φ1) * Math.cos(φ2) * Math.sin(Δλ / 2) * Math.sin(Δλ / 2);
            const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

            return R * c; // Convert to kilometers
        }

    });
</script>
@endsection