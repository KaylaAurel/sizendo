
<!-- About Section -->
<section id="about" class="about section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row align-items-xl-center gy-5">
            <div class="col-xl-5 content">
                <h3>About Us</h3>
                <h2>Siber dan Netizen Indonesia</h2>
                <p>
                    SIZENDO (Siber & Netizen Indonesia) adalah organisasi warganet yang lahir di
                    Kota Pahlawan, Surabaya—kota metropolitan terbesar kedua setelah Jakarta.
                    Sebagai pusat urbanisasi dan teknologi, Surabaya menjadi tolak ukur perilaku
                    warganet dan perkembangan dunia digital di Indonesia.
                </p>
                <p id="more-text" style="display: none;">
                    Organisasi ini bertujuan untuk membangun komunitas digital yang cerdas, inovatif,
                    dan bertanggung jawab dalam menggunakan teknologi informasi. Kami aktif dalam 
                    berbagai kegiatan edukasi, literasi digital, serta kampanye positif di media sosial 
                    guna menciptakan ekosistem digital yang lebih sehat dan produktif.
                </p>
                <a href="javascript:void(0);" class="read-more" id="read-more-btn" onclick="toggleReadMore()">
                    <span>Read More</span>
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <script>
function toggleReadMore() {
    var moreText = document.getElementById("more-text");
    var btnText = document.getElementById("read-more-btn");

    if (moreText.style.display === "none") {
        moreText.style.display = "block";
        btnText.innerHTML = '<span>Read Less</span> <i class="bi bi-arrow-up"></i>';
    } else {
        moreText.style.display = "none";
        btnText.innerHTML = '<span>Read More</span> <i class="bi bi-arrow-right"></i>';
    }
}
</script>

            <div class="col-xl-7">
                <div class="row gy-4 icon-boxes">
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon-box">
                            <i class="bi bi-buildings"></i>
                            <h3>Meningkatkan Literasi Digital </h3>
                            <p>Mengedukasi masyarakat tentang penggunaan internet dan media sosial yang bijak, aman, dan bermanfaat.</p>
                        </div>
                    </div> <!-- End Icon Box -->

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                            <i class="bi bi-clipboard-pulse"></i>
                            <h3>Membangun Komunitas Positif</h3>
                            <p>Mendorong interaksi warganet yang konstruktif, inklusif, dan beretika dalam dunia digital.</p>
                        </div>
                    </div> <!-- End Icon Box -->

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon-box">
                            <i class="bi bi-command"></i>
                            <h3>Melawan Hoaks dan Cyberbullying</h3>
                            <p>Mengkampanyekan penggunaan internet yang bebas dari misinformasi, ujaran kebencian, dan cyberbullying.</p>
                        </div>
                    </div> <!-- End Icon Box -->

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon-box">
                            <i class="bi bi-graph-up-arrow"></i>
                            <h3>Mendukung Inovasi Teknologi</h3>
                            <p>Mewadahi dan mendorong kreativitas serta inovasi digital dalam berbagai bidang untuk kemajuan masyarakat.</p>
                        </div>
                    </div> <!-- End Icon Box -->
                </div>
            </div>
        </div>
    </div>
</section>