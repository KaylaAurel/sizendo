<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIZENDO')</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
</head>
<body class="index-page">


<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            <h1 class="sitename">SIZENDO</h1>
        </a>
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ url('/') }}" class="active">Home</a></li>
                <li><a href="{{ url('/') }}#about">About</a></li>
                <li><a href="{{ url('/#service') }}">Service</a>
                <li><a href="#pricing">KTA Digital</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>


  <main id="main">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="{{ url('/') }}" class="logo d-flex align-items-center">
            <span class="sitename">SIZENDO</span>
          </a>
          <div class="footer-contact pt-3">
            <p>Jl. Yosodipuro, No. 19</p>
            <p>Surabaya, Jawa Timur</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+62 851 5672 7230</span></p>
            <p><strong>Email:</strong> <span>sibernitizen@gmail.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href="https://www.youtube.com/@sizendo"><i class="bi bi-youtube"></i></a>
            <a href="https://www.instagram.com/sibernitizenindonesia?igsh=MWZsN2dqeWFidXZleg=="><i class="bi bi-instagram"></i></a>
      
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
  <h4>Useful Links</h4>
  <ul>
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ url('/#about') }}">About us</a></li>
    <li><a href="{{ url('/#service') }}">Services</a></li>
    <li><a href="{{ url('/#pricing') }}">KTA Digital</a></li>
    <li><a href="{{ url('/#contact') }}">Contact</a></li>
    <li>
      
    </li>
  </ul>
</div>




        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
    <li>Web Design</li>
    <li>Web Development</li>
    <li>Product Management</li>
    <li>Marketing</li>
    <li>Graphic Design</li>
  </ul>
</div>


      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> 
   <strong class="px-1 sitename">
     <a href="{{ route('admin.login') }}" style="text-decoration: none; color: inherit;">SIZENDO</a>
   </strong> 
   <span>All Rights Reserved</span>
</p>

      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">Politeknik Negeri Jember</a>
      </div>
    </div>

  </footer>

      <!-- Scroll Top -->
      <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>