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
    @if (!empty($bookings))
    @foreach ($bookings as $booking)
    <div class="container-fluid pt-0 pb-4 mb-0">
        <div class="row justify-content-center"> <!-- Center the card on mobile -->
            <div class="col-lg-12 col-md-12 col-12"> <!-- Full width on desktop, centered on mobile -->
                <div class="card w-100 mx-auto">
                    <!-- Card Header -->
                    <div class="card-header pb-0 pl-0 pr-0 pt-3 bg-transparent" style="--bs-gutter-x: 0rem;">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="text-uppercase text-sm">{{ $booking->name_place }}</h6>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                @if ($booking->status_booking == 'Pending')
                                    <span class="text-sm bg-warning p-2 rounded text-white">{{ $booking->status_booking }}</span>
                                @elseif ($booking->status_booking == 'Check In')
                                    <span class="text-sm bg-success p-2 rounded text-white">{{ $booking->status_booking }}</span>
                                @elseif ($booking->status_booking == 'Cancelled')
                                    <span class="text-sm bg-danger p-2 rounded text-white">{{ $booking->status_booking }}</span>
                                @elseif ($booking->status_booking == 'Check Out')
                                    <span class="text-sm bg-secondary p-2 rounded text-white">{{ $booking->status_booking }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body pt-3">
                        <div class="row g-3">
                            <!-- Baris 1: No. Booking dan Plat Nomor -->
                            <div class="col-md-6 col-6">
                                <div class="">
                                    <span class="fw-bold text-sm d-block mb-1">No. Booking</span>
                                    <div class="bg-light rounded p-2" style="min-height: 42px; min-width: 100%;">{{ $booking->booking_id }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="">
                                    <span class="fw-bold text-sm d-block mb-1">Plat Nomor</span>
                                    <div class="bg-light rounded p-2" style="min-height: 42px; min-width: 100%;">{{ $booking->no_plat }}</div>
                                </div>
                            </div>

                            <!-- Baris 2: Waktu Checkin dan Total Waktu -->
                            <div class="col-md-6 col-6">
                                <div class="">
                                    <span class="fw-bold text-sm d-block mb-1">Waktu Checkin</span>
                                    <div class="bg-light rounded p-2" style="min-height: 42px; min-width: 100%;">{{ $booking->jam_checkin }}</div>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="">
                                    <span class="fw-bold text-sm d-block mb-1">Total Waktu</span>
                                    <div class="bg-light rounded p-2" style="min-height: 42px; min-width: 100%;">{{ $booking->durasi }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="card-footer pt-0">
                        <div class="row g-3" style="--bs-gutter-x: 0rem;">
                            <!-- Total Harga -->
                            <div class="col-lg-6 col-6">
                                <div class="">
                                    <span class="fw-bold text-sm d-block mb-1">Total Harga</span>
                                    <div class="bg-light rounded p-2" style="min-height: 42px; min-width: 100%;">
                                        <b class="text-xl">{{ $booking->total_bayar }}</b>
                                    </div>
                                </div>
                            </div>
                            <!-- Tombol Detail -->
                            <div class="col-lg-6 col-6 d-flex align-items-center justify-content-center justify-content-lg-end">
                                <a href="{{ url('detail_transaksi/' . $booking->booking_id) }}" class="btn btn-sm btn-info m-1">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endif
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
