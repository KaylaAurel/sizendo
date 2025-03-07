<section id="service" class="details section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Service</h2>
        <div><span>Check Our</span> <span class="description-title">Service</span></div>
    </div>

    <div class="container">
    @php
    $services = [
        [
            'image' => 'details-1.png',
            'title' => 'Pelatihan Keamanan Siber',
            'description' => 'Tingkatkan keamanan digital Anda dengan pelatihan dan simulasi serangan siber.',
            'points' => [
                'Workshop tentang keamanan digital dan perlindungan data.',
                'Simulasi serangan siber & cara mengatasinya.',
                'Edukasi tentang phishing, malware, dan social engineering.'
            ]
        ],
        [
            'image' => 'details-2.png',
            'title' => 'Literasi Digital untuk Netizen Cerdas',
            'description' => 'Menjadi warganet yang cerdas dan bertanggung jawab dengan memahami dunia digital.',
            'extra' => 'Kelas literasi digital ini mengajarkan bagaimana cara menangkal hoax, memahami etika digital, dan menggunakan internet untuk bisnis serta edukasi.'
        ],
        [
            'image' => 'details-3.png',
            'title' => 'Konsultasi Keamanan Akun & Privasi',
            'description' => 'Lindungi akun dan data pribadi Anda dengan konsultasi keamanan digital.',
            'points' => [
                'Membantu mengamankan akun media sosial & email.',
                'Rekomendasi tools VPN, 2FA, dan enkripsi data.',
                'Analisis keamanan situs & aplikasi online.'
            ]
        ],
        
        
    ];
    @endphp

    @foreach ($services as $index => $service)
        <div class="row gy-4 align-items-center features-item">
            <div class="col-md-5 {{ $index % 2 != 0 ? 'order-1 order-md-2' : '' }} d-flex align-items-center" data-aos="zoom-out">
                @php
                    $imagePath = asset('assets/img/' . $service['image']);
                @endphp
                <img src="{{ $imagePath }}" class="img-fluid" alt="{{ $service['title'] }}">
            </div>
            <div class="col-md-7 {{ $index % 2 != 0 ? 'order-2 order-md-1' : '' }}" data-aos="fade-up">
                <h3>{{ $service['title'] }}</h3>
                <p class="fst-italic">{{ $service['description'] }}</p>
                @if (isset($service['points']))
                <ul>
                    @foreach ($service['points'] as $point)
                    <li><i class="bi bi-check"></i> <span>{{ $point }}</span></li>
                    @endforeach
                </ul>
                @endif
                @if (isset($service['extra']))
                <p>{{ $service['extra'] }}</p>
                @endif
            </div>
        </div>
    @endforeach
    </div>
</section>
