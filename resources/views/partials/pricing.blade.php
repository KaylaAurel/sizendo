<section id="pricing" class="pricing section">
  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Layanan Member Sizendo</h2>
    <div><span>Pilih Paket</span> <span class="description-title">Keanggotaan Sizendo</span></div>
  </div><!-- End Section Title -->

  <div class="container">
    <div class="row gy-4">

      <!-- Paket Netizen -->
      <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
        <div class="pricing-item">
          <h3>Netizen</h3>
          <p class="description">Paket dasar untuk anggota baru yang ingin bergabung dan belajar bersama komunitas Siber Netizen Indonesia.</p>
          <h4><sup>Rp</sup>25.000<span> / bulan</span></h4>
          <a href="{{ route('payment', ['paket' => 'Netizen', 'harga' => 25000]) }}" class="cta-btn">
            Gabung Sekarang
          </a>
          <p class="text-center small">Biaya ringan, manfaat besar</p>
          <ul>
            <li><i class="bi bi-check"></i> Akses grup diskusi publik</li>
            <li><i class="bi bi-check"></i> Newsletter bulanan</li>
            <li class="na"><i class="bi bi-x"></i> Webinar eksklusif</li>
            <li class="na"><i class="bi bi-x"></i> E-Sertifikat keanggotaan</li>
          </ul>
        </div>
      </div>

      <!-- Paket Aktivis -->
      <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
        <div class="pricing-item featured">
          <p class="popular">Paling Populer</p>
          <h3>Aktivis</h3>
          <p class="description">Untuk netizen aktif yang ingin berkontribusi dalam gerakan literasi digital dan komunitas daring.</p>
          <h4><sup>Rp</sup>75.000<span> / bulan</span></h4>
          <a href="{{ route('payment', ['paket' => 'Aktivis', 'harga' => 75000]) }}" class="cta-btn">
            Daftar Sekarang
          </a>
          <p class="text-center small">Termasuk akses premium</p>
          <ul>
            <li><i class="bi bi-check"></i> Semua fitur Netizen</li>
            <li><i class="bi bi-check"></i> Webinar eksklusif bulanan</li>
            <li><i class="bi bi-check"></i> Pelatihan literasi digital</li>
            <li><i class="bi bi-check"></i> E-Sertifikat keanggotaan</li>
          </ul>
        </div>
      </div>

      <!-- Paket Inisiator -->
      <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
        <div class="pricing-item">
          <h3>Inisiator</h3>
          <p class="description">Tingkat tertinggi untuk member yang ingin memimpin, menginisiasi proyek komunitas, dan menjadi duta digital.</p>
          <h4><sup>Rp</sup>150.000<span> / bulan</span></h4>
          <a href="{{ route('payment', ['paket' => 'Inisiator', 'harga' => 150000]) }}" class="cta-btn">
            Langganan Sekarang
          </a>
          <p class="text-center small">Akses penuh & eksklusif</p>
          <ul>
            <li><i class="bi bi-check"></i> Semua fitur Aktivis</li>
            <li><i class="bi bi-check"></i> Konsultasi langsung dengan mentor</li>
            <li><i class="bi bi-check"></i> Kesempatan kolaborasi proyek</li>
            <li><i class="bi bi-check"></i> Badge & Profil Spesial</li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</section><!-- /Pricing Section -->
