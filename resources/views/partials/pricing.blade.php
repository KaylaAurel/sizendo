<!-- Pricing Section -->
<section id="pricing" class="pricing section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>KTA Digital</h2>
    <div><span>Check Our</span> <span class="description-title">KTA Digital</span></div>
  </div><!-- End Section Title -->

  <div class="container">
    <div class="row gy-4">

      @foreach ($pricingPlans as $plan)
        <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 + 100 }}">
          <div class="pricing-item {{ $plan['featured'] ? 'featured' : '' }}">
            @if($plan['featured'])
              <p class="popular">Popular</p>
            @endif
            <h3>{{ $plan['name'] }}</h3>
            <p class="description">{{ $plan['description'] }}</p>
            <h4><sup>$</sup>{{ $plan['price'] }}<span> / month</span></h4>
            <a href="#" class="cta-btn">Start a free trial</a>
            <p class="text-center small">No credit card required</p>
            <ul>
              @foreach ($plan['features'] as $feature)
                <li class="{{ $feature['available'] ? '' : 'na' }}">
                  <i class="bi {{ $feature['available'] ? 'bi-check' : 'bi-x' }}"></i>
                  <span>{{ $feature['text'] }}</span>
                </li>
              @endforeach
            </ul>
          </div>
        </div><!-- End Pricing Item -->
      @endforeach

    </div>
  </div>

</section><!-- /Pricing Section -->
