<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Web Personal Profile - Pilihan CV</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- =======================================================
    * Template Name: MyResume
    * Updated: 8 November 2023
    * Referensi : https://bootstrapmade.com/free-html-bootstrap-template-my-resume/
    * Author: WPP 1 : Cravitae's Teams
    ======================================================== -->
</head>

<body>

    <!-- ======= Mobile nav toggle button ======= -->
    <i class="bi bi-list mobile-nav-toggle d-lg-none"></i>

    <!-- ======= Header ======= -->
    <!-- other things -->

    <!-- ======= Content Section ======= -->
    <section class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading text-uppercase">Pilih Jenis CV</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-5 col-sm-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">CV ATS</h5>
                            <p class="card-text">CV disesuaikan untuk sistem ATS (Applicant Tracking System).</p>
                            <a href="{{ url('/lihat') }}" class="btn btn-primary btn-sm">Lihat</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 mb-4">
                    <div class="card">
                        <img src="{{ asset('img/cv-formal.jpg') }}" class="card-img-top" alt="CV Formal">
                        <div class="card-body">
                            <h5 class="card-title">CV Formal</h5>
                            <p class="card-text">CV dengan desain formal dan klasik.</p>
                            <a href="{{ url('/lihat') }}" class="btn btn-primary btn-sm">Lihat</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ======= Footer ======= -->
    <!-- other stuff -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <!-- other vendor scripts -->

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
