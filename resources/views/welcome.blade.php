<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <title>
        Argon Dashboard 2 by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('/assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('/assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/nucleo-icons@2.0.6/css/nucleo-icons.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('/assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('/assets') }}/css/argon-dashboard.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/assets') }}/guest/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/assets') }}/guest/css/animate.css">
    
    <link rel="stylesheet" href="{{ asset('/assets') }}/guest/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('/assets') }}/guest/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('/assets') }}/guest/css/magnific-popup.css">

    <link rel="stylesheet" href="{{ asset('/assets') }}/guest/css/aos.css">

    <link rel="stylesheet" href="{{ asset('/assets') }}/guest/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('/assets') }}/guest/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{ asset('/assets') }}/guest/css/jquery.timepicker.css">

    <link rel="stylesheet" href="{{ asset('/assets') }}/guest/css/flaticon.css">
    <link rel="stylesheet" href="{{ asset('/assets') }}/guest/css/icomoon.css">
    <link rel="stylesheet" href="{{ asset('/assets') }}/guest/css/style.css">
</head>

<body class="{{ $class ?? '' }}">
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
                                        href="">
                                        <i class="fa fa-house opacity-6 text-dark me-1"></i>
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="">
                                        <i class="fa fa-circle-info opacity-6 text-dark me-1"></i>
                                        Tentan Kami
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="">
                                        <i class="fas fa-location-dot opacity-6 text-dark me-1"></i>
                                        Lokasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="">
                                        <i class="fas fa-life-ring opacity-6 text-dark me-1"></i>
                                        Pelayanan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="">
                                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                        Kontak
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="">
                                        <i class="fas fa-quote-left opacity-6 text-dark me-1"></i>
                                        Testimoni
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav d-sm-block sm-mb-2">
                                <li class="nav-item d-flex justify-content-center">
                                    <a href="{{route('login')}}" class="btn btn-sm mb-0 me-1 btn-primary-outline">Login</a>
                                    <a href="{{route('register')}}" class="btn btn-sm mb-0 me-1 btn-primary">Register</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <div class="hero-wrap ftco-degree-bg" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.5)), url('{{ asset('/assets') }}/guest/images/bg-orange.jpg');">
            <div class="container">
              <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
                <div class="col-lg-8 ftco-animate">
                    <div class="text w-100 text-center">
                      <h1 class="mb-4">Temukan Tempat Parkir dengan Mudah dan Cepat!</h1>
                      <p style="font-size: 18px;">ParkHere adalah solusi pintar untuk menemukan dan memesan tempat parkir terdekat. Hemat waktu, hindari stres, dan nikmati pengalaman parkir tanpa ribet</p>
                      {{-- <a href="https://vimeo.com/45830194" class="icon-wrap popup-vimeo d-flex align-items-center mt-4 justify-content-center">
                          <div class="icon d-flex align-items-center justify-content-center">
                              <span class="ion-ios-play"></span>
                          </div>
                          <div class="heading-title ml-5">
                              <span>Easy steps for renting a car</span>
                          </div>
                      </a> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
      
           <section class="ftco-section ftco-no-pt bg-light">
              <div class="container">
                  <div class="row no-gutters">
                      <div class="col-md-12	featured-top">
                          <div class="row no-gutters">
                                <div class="d-flex align-items-center">
                                    <div class="services-wrap rounded-right w-100">
                                        <h3 class="heading-section mb-4 text-center">Keunggulan Layanan Parkir Kami</h3>
                                        <div class="row d-flex mb-4">
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                      <div class="services w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                                        <div class="text w-100">
                                          <h3 class="heading mb-2">Tempat Parkir Rekomendasi Terdekat Dengan Anda</h3>
                                      </div>
                                      </div>      
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                      <div class="services w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center"><span class="fas fa-money-bill"></span></div>
                                        <div class="text w-100">
                                          <h3 class="heading mb-2">Bekerjasama dengan Pemerintah Daerah</h3>
                                        </div>
                                      </div>      
                                    </div>
                                    <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                      <div class="services w-100 text-center">
                                        <div class="icon d-flex align-items-center justify-content-center"><span class="fa-solid fa-shield-halved"></span></div>
                                        <div class="text w-100">
                                          <h3 class="heading mb-2">Bekerjasama dengan Pemerintah Daerah</h3>
                                        </div>
                                      </div>      
                                    </div>
                                  </div>
                                  <p><a href="{{route('dashboard')}}" class="btn btn-primary py-3 px-4 d-flex justify-content-center">Cari Tempat Parkir Sekarang</a></p>
                                    </div>
                                </div>
                            </div>
                      </div>
                </div>
          </section>
      
          <section class="ftco-section ftco-about">
                  <div class="container">
                      <div class="row no-gutters">
                          <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url({{ asset('/assets') }}/guest/images/about.jpg);">
                          </div>
                          <div class="col-md-6 wrap-about ftco-animate">
                    <div class="heading-section heading-section-white pl-md-5">
                        <span class="subheading">Tentang Kami</span>
                      <h2 class="mb-4">Welcome to ParkHere</h2>
      
                      <p>Di ParkHere, kami berkomitmen untuk menyediakan solusi parkir yang mudah, aman, dan efisien. Dengan teknologi canggih dan sistem yang user-friendly, kami membantu Anda menemukan tempat parkir dengan cepat di lokasi strategis. Kami memahami betapa berharga waktu Anda, sehingga kami memudahkan Anda untuk memesan tempat parkir melalui aplikasi kami, memastikan Anda selalu mendapatkan tempat parkir yang nyaman dan terjamin keamanannya.</p>
                       <p>Visi Kami adalah untuk menjadi layanan parkir terdepan yang menawarkan kenyamanan, kemudahan, dan keandalan di setiap perjalanan Anda. Dengan keamanan 24 jam, akses cepat, dan harga yang kompetitif, ParkHere memastikan pengalaman parkir yang bebas stres bagi Anda, kapan saja dan di mana saja.</p>
                    <p>Bergabunglah dengan kami dan nikmati pengalaman parkir yang lebih praktis, tanpa khawatir tentang kesulitan mencari tempat parkir!</p>
                    </div>
                          </div>
                      </div>
                  </div>
              </section>

              <section class="ftco-section ftco-no-pt bg-light pt-8">
                <div class="container">
                    <div class="row justify-content-center">
                  <div class="col-md-12 heading-section text-center ftco-animate ">
                      <span class="subheading">Lokasi Parkir</span>
                    <h2 class="mb-5">Daftar Lokasi Parkir Populer</h2>
                  </div>
                </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="carousel-car owl-carousel">
                                <div class="item">
                                    <div class="car-wrap rounded ftco-animate">
                                        <div class="img rounded d-flex align-items-end" style="background-image: url({{ asset('/assets') }}/guest/images/parkir1.jpeg);">
                                        </div>
                                        <div class="text">
                                            <h2 class="mb-0"><a href="#">ParkHere Unikom Bandung</a></h2>
                                            <div class="d-flex mb-3">
                                                <span>Total Slot Parkir</span>
                                                <p class="ml-auto">15 Slot</p>
                                            </div>
                                            <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1 w-100">Lihat Lokasi Parkir</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="car-wrap rounded ftco-animate">
                                        <div class="img rounded d-flex align-items-end" style="background-image: url({{ asset('/assets') }}/guest/images/parkir1.jpeg);">
                                        </div>
                                        <div class="text">
                                            <h2 class="mb-0"><a href="#">Parkhere Braga Bandung</a></h2>
                                            <div class="d-flex mb-3">
                                                <span>Total Slot Parkir</span>
                                                <p class="ml-auto">15 Slot</p>
                                            </div>
                                            <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1 w-100">Lihat Lokasi Parkir</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="car-wrap rounded ftco-animate">
                                        <div class="img rounded d-flex align-items-end" style="background-image: url({{ asset('/assets') }}/guest/images/parkir1.jpeg);">
                                        </div>
                                        <div class="text">
                                            <h2 class="mb-0"><a href="#">Parkhere Cibiru Bandung</a></h2>
                                            <div class="d-flex mb-3">
                                                <span>Total Slot Parkir</span>
                                                <p class="ml-auto">15 Slot</p>
                                            </div>
                                            <p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1 w-100">Lihat Lokasi Parkir</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
      
              <section class="ftco-section">
                  <div class="container">
                      <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Pelayanan</span>
                  <h2 class="mb-3">Pelayanan Kami</h2>
                </div>
              </div>
                      <div class="row">
                          <div class="col-md-3">
                              <div class="services services-2 w-100 text-center">
                      <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-wedding-car"></span></div>
                      <div class="text w-100">
                      <h3 class="heading mb-2">Parkir Terjaga Sepenuh Hati</h3>
                      <p>Mobil anda akan kami jaga sepenuh hati</p>
                    </div>
                  </div>
                          </div>
                          <div class="col-md-3">
                              <div class="services services-2 w-100 text-center">
                      <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
                      <div class="text w-100">
                      <h3 class="heading mb-2">Tempat Parkir Di Lokasi Strategis</h3>
                      <p>Tempat parkir kami terletak di lokasi strategis</p>
                    </div>
                  </div>
                          </div>
                          <div class="col-md-3">
                              <div class="services services-2 w-100 text-center">
                      <div class="icon d-flex align-items-center justify-content-center"><span class="fas fa-money-bill"></span></div>
                      <div class="text w-100">
                      <h3 class="heading mb-2">Harga Transparan</h3>
                      <p>Harga yang kami tawarkan sangat transparan dan terjangkau</p>
                    </div>
                  </div>
                          </div>
                          <div class="col-md-3">
                              <div class="services services-2 w-100 text-center">
                      <div class="icon d-flex align-items-center justify-content-center"><span class="fa-solid fa-shield-halved"></span></div>
                      <div class="text w-100">
                      <h3 class="heading mb-2">Keamanan Terjamin</h3>
                      <p>Keamanan parkir kami sangat terjamin</p>
                    </div>
                  </div>
                          </div>
                      </div>
                  </div>
              </section>
      
              <section class="ftco-section ftco-intro" style="background-image: url({{ asset('/assets') }}/guest/images/bg_3.jpg);">
                  <div class="overlay"></div>
                  <div class="container">
                      <div class="row justify-content-end">
                          <div class="col-md-6 heading-section heading-section-white ftco-animate">
                  <h2 class="mb-3">Butuh Bantuan ?</h2>
                  <a href="mailto:email@example.com" class="btn btn-primary btn-lg">Hubungi Kami</a>
                </div>
                      </div>
                  </div>
              </section>
      
      
          <section class="ftco-section testimony-section bg-light">
            <div class="container">
              <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Testimoni</span>
                  <h2 class="mb-3">Pelanggan Yang Senang</h2>
                </div>
              </div>
              <div class="row ftco-animate">
                <div class="col-md-12">
                  <div class="carousel-testimony owl-carousel ftco-owl">
                    <div class="item">
                      <div class="testimony-wrap rounded text-center py-4 pb-5">
                        <div class="user-img mb-2" style="background-image: url({{ asset('/assets') }}/guest/images/person_1.jpg)">
                        </div>
                        <div class="text pt-4">
                          <p class="mb-4">ParkHere benar-benar memudahkan saya dalam mencari tempat parkir. Dengan aplikasi ini, saya tidak perlu lagi khawatir mencari parkir di area yang ramai. Cukup beberapa klik, tempat parkir sudah terjamin! Sangat membantu, terutama saat saya sedang terburu-buru.</p>
                          <p class="name">Roger Scott</p>
                          <span class="position">Pengguna Setia ParkHere</span>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="testimony-wrap rounded text-center py-4 pb-5">
                        <div class="user-img mb-2" style="background-image: url({{ asset('/assets') }}/guest/images/person_2.jpg)">
                        </div>
                        <div class="text pt-4">
                          <p class="mb-4">Layanan parkir ParkHere sangat nyaman dan aman. Saya merasa lebih tenang karena ada sistem keamanan 24 jam. Selain itu, aplikasi ParkHere sangat mudah digunakan, dan saya bisa memesan tempat parkir jauh sebelum tiba di lokasi.</p>
                          <p class="name">Roger Scott</p>
                          <span class="position">Pengguna ParkHere</span>
                        </div>
                      </div>
                    </div>
                    <div class="item">
                      <div class="testimony-wrap rounded text-center py-4 pb-5">
                        <div class="user-img mb-2" style="background-image: url({{ asset('/assets') }}/guest/images/person_3.jpg)">
                        </div>
                        <div class="text pt-4">
                          <p class="mb-4">Sebagai orang yang sering bepergian ke berbagai tempat, ParkHere telah menghemat waktu saya. Aplikasi ini memungkinkan saya untuk memesan parkir lebih dulu, jadi saya tidak perlu pusing lagi mencari tempat parkir. Keamanan dan kenyamanannya sangat terjaga dan terjamin.</p>
                          <p class="name">Roger Scott</p>
                          <span class="position">Pengguna ParkHere</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
      
          <footer class="ftco-footer ftco-bg-dark ftco-section">
            <div class="container">
              <div class="row mb-5">
                <div class="col-md">
                  <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2"><img src="{{ asset('/assets') }}/guest/images/Logo.png" style="width:17em"></h2>
                    <p>ParkHere adalah solusi pintar untuk menemukan dan memesan tempat parkir terdekat. Hemat waktu, hindari stres, dan nikmati pengalaman parkir tanpa ribet</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                      <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                      <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                      <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md">
                  <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Information</h2>
                    <ul class="list-unstyled">
                      <li><a href="#" class="py-2 d-block">About</a></li>
                      <li><a href="#" class="py-2 d-block">Services</a></li>
                      <li><a href="#" class="py-2 d-block">Term and Conditions</a></li>
                      <li><a href="#" class="py-2 d-block">Best Price Guarantee</a></li>
                      <li><a href="#" class="py-2 d-block">Privacy &amp; Cookies Policy</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md">
                  <div class="ftco-footer-widget mb-4">
                      <h2 class="ftco-heading-2">Have a Questions?</h2>
                      <div class="block-23 mb-3">
                        <ul>
                          <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                          <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                          <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
                        </ul>
                      </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 text-center">
      
                  <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | ParkHere Company
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
              </div>
            </div>
          </footer>
        <!-- loader -->
    </main>
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
<!--   Core JS Files   -->
    <script src="{{ asset('/assets') }}/guest/js/jquery.min.js"></script>
    <script src="{{ asset('/assets') }}/guest/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="{{ asset('/assets') }}/guest/js/popper.min.js"></script>
    <script src="{{ asset('/assets') }}/guest/js/jquery.easing.1.3.js"></script>
    <script src="{{ asset('/assets') }}/guest/js/jquery.waypoints.min.js"></script>
    <script src="{{ asset('/assets') }}/guest/js/jquery.stellar.min.js"></script>
    <script src="{{ asset('/assets') }}/guest/js/owl.carousel.min.js"></script>
    <script src="{{ asset('/assets') }}/guest/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('/assets') }}/guest/js/aos.js"></script>
    <script src="{{ asset('/assets') }}/guest/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('/assets') }}/guest/js/jquery.timepicker.min.js"></script>
    <script src="{{ asset('/assets') }}/guest/js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('/assets') }}/guest/js/google-map.js"></script>
    <script src="{{ asset('/assets') }}/guest/js/main.js"></script>
    <script src="{{ asset('/assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('/assets') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('/assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('/assets') }}/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('/assets') }}/js/argon-dashboard.js"></script>
    @stack('js');
</body>

</html>
