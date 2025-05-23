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
        @forelse($testimonials as $testimonial)
        <div class="swiper-slide">
          <div class="testimonial-item text-white text-center">

            {{-- Tampilkan foto, atau fallback ke default jika tidak ada --}}
            @if(!empty($testimonial->photo))
              <img src="{{ asset('storage/' . $testimonial->photo) }}" class="rounded-circle mb-3" width="80" alt="{{ $testimonial->name }}">
            @else
              <img src="{{ asset('assets/img/default-profile.png') }}" class="rounded-circle mb-3" width="80" alt="Default Profile">
            @endif

            <h3>{{ $testimonial->name }}</h3>
            <h4>{{ $testimonial->profession }}</h4>

            <div class="stars text-warning mb-2">
              {{-- Tampilkan rating bintang --}}
              @for ($i = 0; $i < $testimonial->rating; $i++)
                <i class="bi bi-star-fill"></i>
              @endfor
              @for ($i = $testimonial->rating; $i < 5; $i++)
                <i class="bi bi-star"></i>
              @endfor
            </div>

            <p>
              <i class="bi bi-quote quote-icon-left"></i>
              <span>{{ $testimonial->message }}</span>
              <i class="bi bi-quote quote-icon-right"></i>
            </p>

          </div>
        </div>
        @empty
        <div class="swiper-slide">
          <div class="testimonial-item text-white text-center">
            <p>Belum ada testimonial.</p>
          </div>
        </div>
        @endforelse
      </div>

      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>
