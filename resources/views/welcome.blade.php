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
                <img src="assets/img/logo 4.png" alt="">
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

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="hero-bg">
                <img src="assets/img/jgu.jpg" alt="">
            </div>
            <div class="container text-center">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h1 data-aos="fade-up">Welcome to <span>LPPM JGU</span></h1>
                    <p data-aos="fade-up" data-aos-delay="100">Dari Ilmu untuk Masyarakat, dari Masyarakat untuk Dunia<br></p>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- Featured Services Section -->
        <section id="featured-services" class="featured-services section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-md" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-briefcase"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Hibah Internal</a></h4>
                                <p class="description">Dana yang disediakan oleh institusi, dalam hal ini Universitas Global Jakarta (JGU), untuk mendukung penelitian yang dilakukan oleh  mahasiswa atau staf universitas.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Item -->

                    <div class="col-md" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item d-flex">
                            <div class="icon flex-shrink-0"><i class="bi bi-card-checklist"></i></div>
                            <div>
                                <h4 class="title"><a href="#" class="stretched-link">Hibah Eksternal</a></h4>
                                <p class="description">Dana yang diperoleh dari sumber di luar institusi, seperti pemerintah, lembaga swasta, organisasi non-profit, atau badan internasional, untuk mendukung penelitian dan proyek akademik.</p>
                            </div>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Featured Services Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="content" data-aos="fade-up" data-aos-delay="100">
                    {{-- <p class="who-we-are">Who We Are</p> --}}
                    <h3>Research Management Center</h3>
                    <p class="fst-italic">
                        Research Management Center (RMC) adalah unsur pelaksana akademik yang melaksanakan sebagian
                        tugas dan fungsi JGU di bidang penelitian yang berada di bawah Wakil Rektor III.
                        RMC dipimpin oleh seorang Ketua yang bertanggung jawab langsung kepada Wakil Rektor III.
                        Ketua dalam melaksanakan tugasnya dibantu oleh 2 (dua) orang Staf. <br> <br>
                        RMC mempunyai tugas melaksanakan koordinasi, pelaksanaan, pemantauan, dan evaluasi kegiatan
                        penelitian. Dalam melaksanakan tugas tersebut RMC menyelenggarakan fungsi:
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> <span>Perbaikan sistem penelitian internal terkait
                                dengan perencanaan, monitoring, dan evaluasi.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Peningkatan kapasitas dan kapabilitas SDM melalui
                                penelitian.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Peningkatan pendanaan penelitian melalui dana
                                internal, kompetisi hibah, dan kerjasama.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Pembentukan pusat studi/Center of Excelence (CoE)
                                sesuai target penelitian strategis.</span></li>
                        <li><i class="bi bi-check-circle"></i> <span>Pembentukan penerbit mandiri yang mampu
                                menerbitkan jurnal ilmiah, buku/modul, dsb.</span></li>
                    </ul>
                </div>

            </div>
        </section><!-- /About Section -->

        <!-- Clients Section -->

        <!-- /Clients Section -->

        <!-- Faq Section -->
        <section id="visi" class="faq section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Visi, Misi dan Tujuan</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

                        <div class="faq-container">

                            <div class="faq-item faq-active">
                                <h3>VISI</h3>
                                <div class="faq-content">
                                    <p>Pada tahun 2030 Menjadi Perguruan Tinggi yang unggul di bidang teknologi,
                                        kesehatan, dan ekonomi relevan dengan kebutuhan industri,
                                        memenuhi harapan global melalui pendidikan holistik,
                                        penelitian dan pengabdian masyarakat yang berkesinambungan untuk masa depan yang
                                        lebih baik</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>MISI</h3>
                                <div class="faq-content">
                                    <p>1. Menyediakan lingkungan pendidikan yang kondusif dan terjangkau bagi masyarakat
                                        serta memfasilitasi pertukaran pengetahuan secara berkesinambungan. <br>
                                        2. Meningkatkan pengetahuan dan penelitian yang selaras dengan kebutuhan
                                        industri. <br>
                                        3. Melaksanakan Penelitian dan pengabdian masyarakat yang sesuai dengan
                                        tantangan nasional dan global. <br>
                                        4. Menghasilkan lulusan bernilai moral tinggi, bermartabat, berjiwa
                                        kepemimpinan, bersikap professional, memiliki integritas, memiliki jiwa sosial
                                        yang tinggi, dan mampu bersaing secara global.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>TUJUAN</h3>
                                <div class="faq-content">
                                    <p>1. Dihasilkannya sumber daya manusia yang bertaqwa kepada Tuhan Yang Maha Esa
                                        dengan kompetensi akademik di bidang teknologi dan kesehatan, professional,
                                        mampu berwirausaha dan bersaing secara global. <br>
                                        2. Terselenggaranya penelitian yang bermanfaat bagi pengembangan keilmuan,
                                        industri, dan profesi di bidang teknologi dan kesehatan. <br>
                                        3. Terselenggaranya berbagai upaya pengabdian masyarakat sebagai sarana
                                        pengabdian civitas akademika yang menunjang peningkatan pemanfaatan teknologi
                                        oleh masyarakat. <br>
                                        4. Terbentuknya jaringan kemitraan dengan berbagai pihak terkait yang bermanfaat
                                        bagi lembaga serta berdampak positif bagi pembangunan di bidang teknologi,
                                        kesehatan, dan ekonomi.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->


                        </div>

                    </div><!-- End Faq Column-->

                </div>

            </div>

        </section><!-- /Faq Section -->

        <!-- Testimonials Section -->
        <section id="struktur" class="testimonials section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Struktur RMC</h2>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper">
                    <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 1
                }
              }
            }
          </script>
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="assets/img/avatars/user.png" class="testimonial-img"
                                    alt="">
                                <h3>(NAMA WAREK 1)</h3>
                                <h4>Wakil Rektor 1</h4>
                                <div class="profile mt-auto">
                                    <p>
                                        (PROFIL SINGKAT)
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="assets/img/avatars/user.png" class="testimonial-img"
                                    alt="">
                                <h3>(NAMA WAREK 2)</h3>
                                <h4>Wakil Rektor 2</h4>
                                <div class="profile mt-auto">
                                    <p>
                                        (PROFIL SINGKAT)
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="assets/img/avatars/user.png" class="testimonial-img"
                                    alt="">
                                <h3>(NAWA WAREK 3)</h3>
                                <h4>Wakil Rektor 3</h4>
                                <div class="profile mt-auto">
                                    <p>
                                        (PROFIL SINGKAT)
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="assets/img/avatars/user.png" class="testimonial-img"
                                    alt="">
                                <h3>(NAMA KEPALA RMC)</h3>
                                <h4>Kepala RMC</h4>
                                <div class="profile mt-auto">
                                    <p>
                                        (PROFIL SINGKAT)
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- /Testimonials Section -->

        <!-- Berita Section -->
    <section id="berita" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Berita</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row g-5">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
                <div class="col-md-4">
                    <img src="{{ asset('/assets/img/avatars/user.png') }}" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body" style="font-family: var(--heading-font);">
                        <h3>Card title</h3>
                        <p>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                    <a href="" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item item-orange position-relative">
            <div class="col-md-4">
                    <img src="{{ asset('/assets/img/avatars/user.png') }}" class="img-fluid rounded-start" alt="...">
            </div>
                <div class="col-md-8">
                    <div class="card-body" style="font-family: var(--heading-font);">
                        <h3>Card title</h3>
                        <p>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                    <a href="" class="read-more stretched-link">Learn More <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
          </div><!-- End Service Item -->
          <a href="#" class="read-moree" style="width: 175px;"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
        </div>

      </div>

    </section><!-- /Services Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Kontak</h2>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="200">
                            <i class="bi bi-geo-alt"></i>
                            <h3>Alamat</h3>
                            <p>Jl. Boulevard Grand Depok City, Kec. Sukmajaya, Kota Depok, Jawa Barat 16412</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="300">
                            <i class="bi bi-telephone"></i>
                            <h3>Hubugi Kami</h3>
                            <p>+62 851 5921 1558</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="info-item d-flex flex-column justify-content-center align-items-center"
                            data-aos="fade-up" data-aos-delay="400">
                            <i class="bi bi-envelope"></i>
                            <h3>Email Kami</h3>
                            <p>rmc@jgu.ac.id</p>
                        </div>
                    </div><!-- End Info Item -->

                </div>

                <div class="row gy-4 mt-1">
                    <div class="w-full" data-aos="fade-up" data-aos-delay="300">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.253269460612!2d106.82579281431468!3d-6.419068663799591!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69eb97981e953d%3A0x7040f2673277d58f!2sTaman%20Mini%20Indonesia%20Indah!5e0!3m2!1sen!2sid!4v1623380352689!5m2!1sen!2sid"
                            frameborder="0" style="border:0; width: 100%; height: 400px;" allowfullscreen=""
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div><!-- End Google Maps -->


                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer position-relative">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="" class="logo d-flex align-items-center">
                        <img src="assets/img/logo.png" class="img-fluid" alt="">
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
