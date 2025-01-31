@extends('layout.app', ['class' => 'g-sidenav-show bg-gray-100'])
<!-- Menu -->
@section('menu')
    @include('Admin.menu')
@endsection

@section('title')
    Dashboard
@endsection

<!-- content -->
@section('content')
    @include('layout.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Pendapatan Hari Ini</p>
                                    <h5 class="font-weight-bolder">
                                        Rp{{$pendapatan_hari_ini}}
                                    </h5>
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
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Transaksi Hari Ini</p>
                                    <h5 class="font-weight-bolder">
                                        {{$transaksi_hari_ini}}
                                    </h5>
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
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Tempat Parkir Buka</p>
                                    <h5 class="font-weight-bolder">
                                        {{$tempat_parkir_buka}}
                                    </h5>
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
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Pelanggan</p>
                                    <h5 class="font-weight-bolder">
                                        {{$jumlah_pelanggan}}
                                    </h5>
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
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Transaksi Hari Ini</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center ">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder">Nama
                                        Tempat Parkir</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder ps-2">No
                                        Plat</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-center">
                                        Durasi</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-center">
                                        Status Bayar</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder text-center">
                                        Total Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($table_transaktions as $table_transaktion)
                                <tr>
                                    <td>{{$table_transaktion->name_place}}</td>
                                    <td>{{$table_transaktion->no_plat}}</td>
                                    <td>{{$table_transaktion->durasi}}</td>
                                    <td>{{$table_transaktion->status_bayar}}</td>
                                    <td>{{$table_transaktion->total_bayar}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Tempat Parkir</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            @foreach ($table_places as $table_place)
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="fas fa-map-marker-alt text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">{{$table_place->name_place}}</h6>
                                        <span class="text-xs">Status <span class="font-weight-bold {{ $table_place->status_place == 'Buka' ? 'text-success' : 'text-danger' }}">{{$table_place->status_place}}</span></span>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @include('layout.footers.auth.footer')
    </div>
@endsection

@push('js')
@endpush
