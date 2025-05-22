@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section id="hero" class="hero section dark-background">
    <img src="/assets/img/sizendo.png" alt="sizendo" class="hero-bg">

    <div class="container">
        <div class="row gy-4 justify-content-between">
            <div class="col-lg-4 order-lg-last hero-img" data-aos="zoom-out" data-aos-delay="100">
                <img src="/assets/img/sizendo.png" class="img-fluid animated" alt="">
            </div>

            <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-in">
                <h1>Siber dan Netizen <span>Indonesia</span></h1>
                <p>Organisasi Warganet Cerdas</p>
                <div class="d-flex">
                    <a href="/#pricing" class="btn-get-started">Join</a>
                    <a href="https://youtu.be/XQJPUAKAqgE?si=EdvwGnMYiTp996Lg" class="glightbox btn-watch-video d-flex align-items-center">
                        <i class="bi bi-play-circle"></i>
                        <span>Watch Video</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none">
        <defs>
            <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
        </defs>
        <g class="wave1">
            <use xlink:href="#wave-path" x="50" y="3"></use>
        </g>
        <g class="wave2">
            <use xlink:href="#wave-path" x="50" y="0"></use>
        </g>
        <g class="wave3">
            <use xlink:href="#wave-path" x="50" y="9"></use>
        </g>
    </svg>
</section>
<!-- /Hero Section -->

<!-- About Section -->
@include('partials.about')

<!-- Service Section -->
@include('partials.service')

<!-- Testimonials Section -->
@include('partials.testimonials')

<!-- Pricing Section - with $pakets passed -->
@include('partials.pricing')

<!-- FAQ Section -->
@include('partials.faq')

<!-- Contact Section -->
@include('partials.contact')

@endsection

@section('scripts')
<script>
    var swiper = new Swiper('.swiper-container', {
        loop: true,
        speed: 600,
        autoplay: {
            delay: 5000,
        },
        slidesPerView: 'auto',
        pagination: {
            el: '.swiper-pagination',
            type: 'bullets',
            clickable: true,
        },
    });
</script>
@endsection
