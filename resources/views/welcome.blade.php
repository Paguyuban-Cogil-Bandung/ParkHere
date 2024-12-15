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
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero {
            background-color:rgb(255, 102, 0);
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .section {
            padding: 60px 0;
        }
    </style>
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
                            <img src="{{ asset('/img') }}/logo.png" class="img-fluid" style="height: 2em;" alt="main_logo">
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
                                        <i class="fa fa-chart-pie opacity-6 text-dark me-1"></i>
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="">
                                        <i class="fa fa-user opacity-6 text-dark me-1"></i>
                                        About Us
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="">
                                        <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                                        Contact
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-2" href="">
                                        <i class="fas fa-key opacity-6 text-dark me-1"></i>
                                        FAQ
                                    </a>
                                </li>
                            </ul>
                            <ul class="navbar-nav d-lg-block d-none">
                                <li class="nav-item">
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
        <!-- Hero Section -->
    <div class="hero" id="home">
        <div class="container pt-5">
        <h1>Selamat Datang di Landing Page Kami</h1>
        <p>Ini adalah contoh landing page sederhana menggunakan Bootstrap.</p>
        <a href="#about" class="btn btn-light">Pelajari Lebih Lanjut</a>
        </div>
    </div>

    <!-- About Us Section -->
    <div class="section" id="about">
        <div class="container">
            <h2>Tentang Kami</h2>
            <p>Kami adalah perusahaan yang berkomitmen untuk memberikan layanan terbaik kepada pelanggan kami. Dengan pengalaman bertahun-tahun di industri ini, kami memahami kebutuhan dan harapan Anda.</p>
            <p>Visi kami adalah menjadi pemimpin dalam industri ini dengan inovasi dan layanan yang unggul.</p>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="section bg-light" id="contact">
        <div class="container">
            <h2>Kontak Kami</h2>
            <p>Jika Anda memiliki pertanyaan atau ingin berkolaborasi, jangan ragu untuk menghubungi kami.</p>
            <form>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" placeholder="Masukkan nama Anda">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Masukkan email Anda">
                </div>
                <div class="form-group">
                    <label for="message">Pesan</label>
                    <textarea class="form-control" id="message" rows="3" placeholder="Tulis pesan Anda"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="section" id="faq">
        <div class="container">
            <h2>FAQ</h2>
            <div class="accordion" id="faqAccordion">
                <div class="card mb-3">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Apa itu layanan kami?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#faqAccordion">
                        <div class="card-body">
                            Kami menyediakan berbagai layanan yang dirancang
                        untuk memenuhi kebutuhan pelanggan kami, termasuk konsultasi, pengembangan produk, dan dukungan teknis.
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Bagaimana cara menghubungi kami?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#faqAccordion">
                        <div class="card-body">
                            Anda dapat menghubungi kami melalui formulir kontak di halaman ini atau melalui email di info@brand.com.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Apakah ada biaya untuk layanan kami?
                            </button>
                        </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#faqAccordion">
                        <div class="card-body">
                            Biaya layanan kami bervariasi tergantung pada jenis layanan yang Anda pilih. Silakan hubungi kami untuk informasi lebih lanjut.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4">
        <p>&copy; 2023 Brand. Semua hak dilindungi.</p>
        <p><a href="#home">Kembali ke atas</a></p>
    </footer>

    </main>
<!--   Core JS Files   -->
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
