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
                            <h6 class="text-uppercase text-sm">ParkHere Unikom Bandungg</h6>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-uppercase text-sm">Pantauan</h6>
                        </div>
                    </div>
                    <div class="card-body pt-3">
                        {{-- <iframe width="100%" height="315" src="{{ $data->url_stream }}" allowfullscreen></iframe> --}}
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

        <div class="row pb-3">
            <div class="mb-xl-0">
                <div class="card">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-uppercase text-sm">Lokasi</h6>
                            <div>
                                <a href="https://maps.app.goo.gl/dVgJuwjQDdB9jEax8" class="btn btn-sm btn-info">Lihat Lokasi</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-3">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.029660652463!2d107.61289967379024!3d-6.88705066738956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6f8aa08188b%3A0x632d24e6061e8903!2sUniversitas%20Komputer%20Indonesia%20(UNIKOM)!5e0!3m2!1sid!2sid!4v1736328214930!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
