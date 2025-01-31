@extends('layout.app')
@section('title')
    Register
@endsection
@section('content')
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav
                    class="navbar navbar-expand-lg blur border-radius-lg top-0 z-index-3 shadow position-absolute mt-4 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid">
                        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="{{route('welcome')}}">
                            <img src="{{ asset('/assets') }}/guest/images/Logo.png" class="img-fluid" style="height: 2em;" alt="main_logo">
                        </a>
                        <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon mt-2">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navigation">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link d-flex align-items-center me-2 active" aria-current="page"
                                        href="{{route('welcome')}}">
                                        <i class="fa fa-house opacity-6 text-dark me-1"></i>
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="{{route('welcome')}}#tentang-kami">
                                        <i class="fa fa-circle-info opacity-6 text-dark me-1"></i>
                                        Tentang Kami
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="{{route('welcome')}}#lokasi">
                                        <i class="fas fa-location-dot opacity-6 text-dark me-1"></i>
                                        Lokasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="{{route('welcome')}}#pelayanan">
                                        <i class="fas fa-life-ring opacity-6 text-dark me-1"></i>
                                        Pelayanan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="{{route('welcome')}}#kontak">
                                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                        Kontak
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="{{route('welcome')}}#testimoni">
                                        <i class="fas fa-quote-left opacity-6 text-dark me-1"></i>
                                        Testimoni
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav d-sm-block sm-mb-2">
                                @if (Auth::check() == true)
                                    @if (Auth::user()->usertype == 'admin')
                                      <a href="{{route('admin.dashboard')}}" class="btn btn-sm mb-0 me-1 btn-primary">Dashboard</a>
                                    @elseif(Auth::user()->usertype == 'petugas')
                                      <a href="{{route('petugas.dashboard')}}" class="btn btn-sm mb-0 me-1 btn-primary">Dashboard</a>
                                    @else
                                      <a href="{{route('dashboard')}}" class="btn btn-sm mb-0 me-1 btn-primary">Dashboard</a>
                                    @endif
                                @else
                                  <li class="nav-item d-flex justify-content-center">
                                      <a href="{{route('login')}}" class="btn btn-sm mb-0 me-1 btn-primary-outline">Login</a>
                                      <a href="{{route('register')}}" class="btn btn-sm mb-0 me-1 btn-primary">Register</a>
                                  </li>
                                @endif
                              </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="pt-6 col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h4 class="font-weight-bolder">Register</h4>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" id="name" class="form-control form-control-lg" placeholder="Your Name" aria-label="Name" name="name" required autofocus>
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <div class="mb-3">
                                            <input type="email" id="email" class="form-control form-control-lg" placeholder="Email" aria-label="Email" name="email" required autofocus>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="mb-3">
                                            <input id="password" type="password" class="form-control form-control-lg" placeholder="Password"
                                                aria-label="password" required name="password" autocomplete="new-password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                        <div class="mb-3">
                                            <input id="password_confirmation" type="password" class="form-control form-control-lg" placeholder="Password Confirmation"
                                                aria-label="password_confirmation" required name="password_confirmation" autocomplete="new-password>
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Register</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Already Registered?
                                        <a href="{{route('login')}}" class="text-primary text-gradient font-weight-bold">Log In</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signin-ill.jpg');
              background-size: cover;">
                                <span class="mask bg-gradient-primary opacity-6"></span>
                                <h4 class="mt-5 text-white font-weight-bolder position-relative">"Attention is the new
                                    currency"</h4>
                                <p class="text-white position-relative">The more effortless the writing looks, the more
                                    effort the writer actually put into the process.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection