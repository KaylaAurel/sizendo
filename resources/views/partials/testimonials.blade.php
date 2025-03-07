<section id="testimonials" class="testimonials section dark-background">
  <img src="{{ asset('assets/img/testimonials-bg.jpg') }}" class="testimonials-bg" alt="Testimonials Background">
  
  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="swiper init-swiper">
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
          }
        }
      </script>
      <div class="swiper-wrapper">
        @foreach ($testimonials as $testimonial)
          <div class="swiper-slide">
            <div class="testimonial-item">
              <img src="{{ asset($testimonial['image']) }}" class="testimonial-img" alt="{{ $testimonial['name'] }}">
              <h3>{{ $testimonial['name'] }}</h3>
              <h4>{{ $testimonial['position'] }}</h4>
              <div class="stars">
                @for ($i = 0; $i < 5; $i++)
                  <i class="bi bi-star-fill"></i>
                @endfor
              </div>
              <p>
                <i class="bi bi-quote quote-icon-left"></i>
                <span>{{ $testimonial['quote'] }}</span>
                <i class="bi bi-quote quote-icon-right"></i>
              </p>
            </div>
          </div>
        @endforeach
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>
