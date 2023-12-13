@extends('layouts.app')

@section('title', 'Home')

@section('content')

    <section class="blok-pertama" style="padding: 80px">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="display-6" style="font-family: Montserrat; font-size: 65px; font-weight:700;">CV MAKER PLATFORM</h1>
                    <h2 class="display-1">Let’s Boost Your Personal Branding!</h2>
                    <p class="display-6">
                        Elevate Your CV. Unleash Opportunities. Your path to a captivating
                        and impactful CV begins here. Join us today!
                    </p>
                    <div class="btn-group" role="group">
                        <a href="{{ url('/personal') }}" class="btn btn-outline-secondary"
                            style=" 
                              background-color: #c3dce3;
                              color: #265172;
                              border-radius: 10px;
                            ">CREATEYOUR OWN </a>
                        <button type="button" class="btn btn-outline-secondary"
                            style="
                margin-left: 20px;
                background-color: #c3dce3;
                color: #265172;
                border-radius: 10px;
              ">
                            Explore →
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <img src="image/karakter.png" alt="karakter" class="img-fluid" />
                </div>
            </div>
        </div>
    </section>
    <section class="blok-kedua" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="image/kaca.png" alt="Kaca" class="img-fluid" />
                </div>
                <div class="col-md-6">
                    <h1 class="display-1">Unlock New Career Opportunities</h1>
                    <h2 class="display-6">
                        Discover exciting new career paths and open doors to endless
                        possibilities.
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <section class="blok-ketiga">
        <div class="container">
            <div class="row">
                <div class="col-md-6" data-aos="fade-up-right">
                    <h1 class="display-1">Expand Your Work</h1>
                    <h2 class="display-6">
                        Broaden your horizons and elevate your professional journey.
                    </h2>
                </div>
                <div class="col-md-6" data-aos="fade-up-left">
                    <img src="image/jabat%20tangan.png" class="img-fluid" />
                </div>
            </div>
        </div>
    </section>
    <section class="blok-keempat" data-aos="zoom-in-up">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img src="image/cv.png" alt="CV" class="img-fluid" />
                </div>
                <div class="col-md-6">
                    <h1 class="display-1">Choose Your CV Styles</h1>
                    <h2 class="display-6">
                        Tailor your CV to reflect your unique personality and
                        professionalism.
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />
    <script>
        AOS.init();
    </script>
    @include('layouts.footer')
@endsection
