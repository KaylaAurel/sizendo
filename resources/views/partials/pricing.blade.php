<section id="pricing" class="pricing section py-3" style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);">
  <div class="container section-title text-center mb-3" data-aos="fade-up" style="padding-top: 2rem">
    <h2 class="fw-bold mb-3" style="letter-spacing: 1px; text-transform: uppercase; color: #2c3e50;">
      Layanan Member Sizendo
    </h2>
    <p class="lead" style="font-size: 1.2rem;">
      <span class="text-primary fw-bold">Pilih Paket</span> 
      <span class="text-muted">Keanggotaan Sizendo</span>
    </p>
  </div>

  <div class="container" style="padding-bottom: 5rem; padding-top: -10px;">
    <div class="row gy-5 justify-content-center">
      @foreach ($pakets as $index => $paket)
        <div class="col-md-6 col-lg-4" data-aos="zoom-in" data-aos-delay="{{ 100 * ($index + 1) }}">
          <div class="card pricing-card h-100 shadow {{ $paket->popular ? 'border-primary featured' : '' }}">
            
            @if($paket->popular)
              <div class="badge-popular animate-popular">
                <i class="bi bi-star-fill me-1"></i> Paling Populer
              </div>
            @endif

            <div class="card-body d-flex flex-column">
              <h3 class="card-title text-center mb-4 paket-title">{{ $paket->nama }}</h3>
              <p class="card-text text-center text-muted flex-grow-1 paket-desc">{{ $paket->deskripsi }}</p>
              
              <h4 class="text-center mb-4 harga-paket">
                <sup>Rp</sup>{{ number_format($paket->harga, 0, ',', '.') }}
                <span class="fs-6">/ bulan</span>
              </h4>

              <ul class="list-unstyled mb-3 fitur-list">
                @php
                  $fiturList = is_array($paket->fitur) ? $paket->fitur : explode(',', $paket->fitur ?? '');
                @endphp
                @foreach ($fiturList as $fitur)
                  @if (Str::startsWith($fitur, '-'))
                    <li class="text-danger fitur-item">
                      <i class="bi bi-x-circle me-2"></i> {{ ltrim($fitur, '-') }}
                    </li>
                  @else
                    <li class="text-success fitur-item">
                      <i class="bi bi-check-circle me-2"></i> {{ $fitur }}
                    </li>
                  @endif
                @endforeach
              </ul>

              <a href="{{ route('payment') }}?paket={{ urlencode($paket->nama) }}&harga={{ $paket->harga }}" 
                 class="btn btn-primary btn-lg w-100 mt-auto cta-btn">
                {{ $paket->popular ? 'Daftar Sekarang' : 'Gabung Sekarang' }}
              </a>

              <p class="text-center text-muted small mt-2 paket-note">
                {{ $paket->popular ? 'Termasuk akses premium' : 'Biaya ringan, manfaat besar' }}
              </p>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  <style>
    /* CARD */
    .pricing-card {
      border-radius: 1rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      position: relative;
      padding-top: 1rem;
      min-height: 100px;
      display: flex;
      flex-direction: column;
      background: #fff;
    }

    .pricing-card:hover {
      transform: translateY(-10px) scale(1.03);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
      z-index: 10;
    }

    /* Badge Populer */
    .badge-popular {
      position: absolute;
      top: -1.2rem;
      left: 50%;
      transform: translateX(-50%);
      background: linear-gradient(to right, #ff416c, #ff4b2b);
      color: white;
      font-weight: bold;
      padding: 0.5rem 1.5rem;
      border-radius: 50px;
      font-size: 0.9rem;
      box-shadow: 0 0 20px rgba(255, 75, 43, 0.6);
      z-index: 20;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .animate-popular {
      animation: pulse-glow 2.5s infinite ease-in-out;
    }

    @keyframes pulse-glow {
      0%, 100% {
        box-shadow: 0 0 20px rgba(255, 75, 43, 0.6);
        transform: translateX(-50%) scale(1);
      }
      50% {
        box-shadow: 0 0 30px rgba(255, 75, 43, 1);
        transform: translateX(-50%) scale(1.05);
      }
    }

    /* Titles */
    .paket-title {
      font-weight: 700;
      font-size: 1.75rem;
      color: #2c3e50;
      letter-spacing: 0.03em;
    }

    .paket-desc {
      font-size: 1.05rem;
      line-height: 1.5;
      margin-bottom: 2rem;
    }

    /* Harga */
    .harga-paket sup {
      font-size: 1.1rem;
      font-weight: 700;
    }

    .harga-paket span {
      color: #777;
    }

    /* Fitur list */
    .fitur-list {
      padding-left: 1rem;
      font-size: 1rem;
      line-height: 1.6;
    }

    .fitur-item {
      margin-bottom: 0.7rem;
      transition: color 0.3s ease;
    }

    .fitur-item i {
      font-size: 1.1rem;
      vertical-align: middle;
    }

    .fitur-item.text-success:hover {
      color: #03721DFF;
    }

    .fitur-item.text-danger:hover {
      color: #AA0314FF;
    }

    /* Button */
    .cta-btn {
      font-weight: 700;
      letter-spacing: 0.05em;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .cta-btn:hover {
      background-color: #0056b3;
      color: #fff;
      box-shadow: 0 0 12px rgba(0, 86, 179, 0.6);
    }

    /* Note bawah */
    .paket-note {
      font-style: italic;
      letter-spacing: 0.10em;
    }
  </style>
</section>
