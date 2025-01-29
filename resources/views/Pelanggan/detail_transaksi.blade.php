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
                            <h6 class="text-uppercase text-sm">ParkHere Unikom Bandung</h6>
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


                        <video id="my_video" class="video-js vjs-default-skin" controls preload="auto" autoplay>
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
                            <div>
                                <a href="" class="btn btn-sm btn-warning">Booking Sekarang</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Slot Parkir Tersedia</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">40</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Harga Awal</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">Rp. 10.000</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Harga per Jam</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">Rp. 5.000</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <table>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Total Slot</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">500</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="text-sm">Status Tempat Parkir</span>
                                            <span class="text-sm">:</span>
                                            <span class="text-sm">Buka</span>
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
@endsection
