<!-- Pricing Section -->
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
          <a href="#" class="cta-btn" data-bs-toggle="modal" data-bs-target="#modalDaftar" data-paket="Netizen">Gabung Sekarang</a>
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
          <a href="#" class="cta-btn" data-bs-toggle="modal" data-bs-target="#modalDaftar" data-paket="Aktivis">Daftar Sekarang</a>
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
          <a href="#" class="cta-btn" data-bs-toggle="modal" data-bs-target="#modalDaftar" data-paket="Inisiator">Langganan Sekarang</a>
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
<!-- Modal Pendaftaran Member -->
<div class="modal fade" id="modalDaftar" tabindex="-1" aria-labelledby="modalDaftarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="modalDaftarLabel">Form Pendaftaran Member</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>

      <form action="{{ url('/proses-daftar') }}" method="POST">
    @csrf
    <div class="modal-body">
        <div class="mb-3">
            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('nama_member') is-invalid @enderror" id="namaLengkap" name="nama_member" value="{{ old('nama_member') }}" required>
            @error('nama_member')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="emailMember" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailMember" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="paketPilihan" class="form-label">Paket Keanggotaan</label>
            <input type="text" class="form-control" id="paketPilihan" name="paket" readonly>
        </div>
        <div class="mb-3">
            <label for="noHp" class="form-label">Nomor HP / WhatsApp</label>
            <input type="text" class="form-control @error('no_wa') is-invalid @enderror" id="noWa" name="no_wa" value="{{ old('no_wa') }}" required>
            @error('no_wa')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="sosmed" class="form-label">Sosial Media (Opsional)</label>
            <input type="text" class="form-control" id="sosmed" name="sosmed" value="{{ old('sosmed') }}">
        </div>
        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan (Opsional)</label>
            <textarea class="form-control" id="catatan" name="catatan" rows="3">{{ old('catatan') }}</textarea>
        </div>
    </div>
    
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Kirim Pendaftaran</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    </div>
</form>


      
    </div>
  </div>
</div>
<script>
  // Saat tombol CTA diklik, isi nilai paket ke input readonly
  const modalDaftar = document.getElementById('modalDaftar');
  modalDaftar.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const paket = button.getAttribute('data-paket');
    const paketInput = modalDaftar.querySelector('#paketPilihan');
    paketInput.value = paket;
  });
</script>
