<section id="pricing" class="pricing section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Layanan Member Sizendo</h2>
    <div>
      <span>Pilih Paket</span> <span class="description-title">Keanggotaan Sizendo</span>
    </div>
  </div>

  <div class="container">
    <div class="row gy-4">
      @foreach ($pakets as $index => $paket)
        <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="{{ 100 * ($index + 1) }}">
          <div class="pricing-item {{ $paket->is_featured ? 'featured' : '' }}">
            @if($paket->is_featured)
              <p class="popular">Paling Populer</p>
            @endif

            <h3>{{ $paket->name }}</h3>
            <p class="description">{{ $paket->deskripsi }}</p>
            <h4><sup>Rp</sup>{{ number_format($paket->price, 0, ',', '.') }}<span> / bulan</span></h4>
            
            <a href="{{ route('payment') }}?paket={{ $paket->name }}&price={{ $paket->price }}" class="cta-btn">
              {{ $paket->is_featured ? 'Daftar Sekarang' : 'Gabung Sekarang' }}
            </a>

            <p class="text-center small">{{ $paket->keterangan }}</p>

            <ul>
              @foreach ($paket->fitur as $fitur)
                @if (Str::startsWith($fitur, '-'))
                  <li class="na"><i class="bi bi-x"></i> {{ ltrim($fitur, '-') }}</li>
                @else
                  <li><i class="bi bi-check"></i> {{ $fitur }}</li>
                @endif
              @endforeach
            </ul>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
