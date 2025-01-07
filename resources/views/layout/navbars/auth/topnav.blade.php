<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}" id="navbarBlur"
        data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ $title }}</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">{{ $title }}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-4 d-flex align-items-center">
            </div>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item dropdown pe-2 ml-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user me-sm-1"></i>
                        <span>{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        <li class="mb-2">
                                <a href="" class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <h6 class="text-sm mb-1">
                                            <i class="fa fa-user me-1"></i>
                                            <span class="text-black text-sm">Profile</span>
                                        </h6>
                                    </div>
                                </a>
                        </li>
                        <li class="mb-2">
                            <form role="form" method="post" action="{{ route('logout') }}">
                            @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <h6 class="text-sm mb-1">
                                            <i class="fas fa-sign-out-alt me-1"></i>
                                            <span class="text-black text-sm">Log out</span>
                                        </h6>
                                    </div>
                                </a>
                            </form>
                        </li>
                    </ul>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@if(Auth::user()->usertype === 'petugas')
<div class="container-fluid py-0 pt-0 pb-0">
    <div class="row">
        <div class="mb-xl-0">
            <div class="card">
                <span class="text-sm px-2 py-2"><i class="fa fa-location-dot"></i> Lokasi Penugasan : <b>ParkHere Unikom Bandung</b></span> 
            </div>
        </div>
    </div>
</div>
@endif
<!-- End Navbar -->
