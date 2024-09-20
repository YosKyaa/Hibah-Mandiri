<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Welcome to RMC System</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="" class="logo d-flex align-items-center me-auto">
                <img src="assets/img/RMC LOGO.png" alt="">
                <h1 class="sitename">RMC SYSTEM</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#visi">Visi & Misi</a></li>
                    <li><a href="#struktur">Struktur</a></li>
                    <li><a href="#berita">Berita</a></li>
                    <li><a href="#contact">Hubugi Kami</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{ route('login') }}">Login</a>

        </div>
    </header>

    <main class="main">

        <!-- Contact Section -->
        <section id="berita" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">
           
            <div class="container">
   
    <h1>Menelusuri Akar Konflik Palestina - Israel: Perspektif Departemen Kastrat</h1>
    <div class="image-container">
        <img src="assets/img/jgu.jpg" alt="Gambar Konflik Palestina - Israel">
    </div>
    
    <small>09 September 2024</small>
    
    <h4>Pemicu Terjadinya Konflik</h4>
    <p>
        Sejarah mencatat bahwa salah satu pemicu utama konflik Palestina-Israel adalah Deklarasi Balfour pada tahun 1917.
        Deklarasi ini, yang dikeluarkan oleh Menteri Luar Negeri Inggris, Arthur Balfour, mendukung pembentukan "Tanah Air
        Nasional bagi Orang-orang Yahudi" di Palestina. Hal ini memicu keinginan Israel untuk mengakuisisi wilayah tersebut.
        Salah satu daerah yang diperebutkan adalah Gaza, yang saat ini menjadi pusat perang yang tidak terkendali dan
        memakan banyak korban jiwa.
    </p>
    
</div>
            
            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer position-relative">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="" class="logo d-flex align-items-center">
                        <img src="assets/img/CIS.png" class="img-fluid" alt="">
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. Boulevard Raya No. 2 Grand Depok City</p>
                        <p>Depok 16412</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+62 851 5921 1558</span></p>
                        <p><strong>Email:</strong> <span>rmc@jgu.ac.id</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#hero" class="active">Beranda</a></li>
                        <li><a href="#about">Tentang</a></li>
                        <li><a href="#visi">Visi & Misi</a></li>
                        <li><a href="#struktur">Struktur</a></li>
                        <li><a href="#contact">Hubungi Kami</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">YAP's CODE
                </strong><span>{{ date('Y') == '2024' ? date('Y') : '2024-' . date('Y') }} All Rights Reserved</span>
            </p>

        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/welcom.js"></script>
    <script src="assets/js/welcom2.js"></script>

</body>

</html>
