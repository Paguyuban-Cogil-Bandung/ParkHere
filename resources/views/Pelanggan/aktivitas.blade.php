@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])
<!-- Menu -->
@section('menu')
    @include('Pelanggan.menu')
@endsection

@section('title')
    Riwayat Aktivitas
@endsection

<!-- content -->
@section('content')
    @include('layout.navbars.auth.topnav', ['title' => 'Riwayat Aktitas'])
    <div class="container-fluid py-0 pt-0 pb-0 mb-0">
        <div class="row w-100 pt-3">
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
                                    <a href="" class="btn btn-sm btn-info m-1">Detail</a>
                                    <a href="" class="btn btn-sm btn-warning m-1">Bayar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row w-100 pt-3">
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
                                    <a href="" class="btn btn-sm btn-info m-1">Detail</a>
                                    <a href="" class="btn btn-sm btn-warning m-1">Bayar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row w-100 pt-3">
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
                                    <a href="" class="btn btn-sm btn-info m-1">Detail</a>
                                    <a href="" class="btn btn-sm btn-warning m-1">Bayar</a>
                                </div>
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
@endsection