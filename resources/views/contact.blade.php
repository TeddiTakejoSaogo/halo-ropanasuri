@extends('layouts.app')

@section('title', 'Kontak Kami')

@section('content')
<style>
    :root {
        --color-navy: #0F3460;
        --color-teal: #16a085;
        --color-teal-light: #e8f6f3;
        --glass-bg: rgba(255, 255, 255, 0.9);
        --glass-border: rgba(255, 255, 255, 0.2);
    }

    /* Hero Section */
    .hero-header {
        background: linear-gradient(135deg, rgba(15, 52, 96, 0.8) 0%, rgba(26, 26, 46, 0.9) 100%), 
                    url('https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=1920&q=80');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        padding: 100px 0;
        position: relative;
    }
    .hero-header::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: radial-gradient(circle, rgba(22,160,133,0.2) 0%, rgba(0,0,0,0) 70%);
    }

    /* Section Headings */
    .section-title {
        color: var(--color-navy);
        font-weight: 700;
        position: relative;
        display: inline-block;
        margin-bottom: 40px;
    }
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 3px;
        background: var(--color-teal);
        border-radius: 3px;
    }

    /* Feature Cards (Contact Info) */
    .feature-card {
        background: white;
        border-radius: 16px;
        padding: 35px 25px;
        text-align: center;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .feature-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: var(--color-teal);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(15, 52, 96, 0.1);
    }
    
    .feature-card:hover::after {
        transform: scaleX(1);
    }

    .icon-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 25px;
        background: var(--color-teal-light);
        color: var(--color-teal);
        transition: all 0.4s ease;
    }

    .feature-card:hover .icon-wrapper {
        background: var(--color-teal);
        color: white;
        transform: rotateY(180deg);
    }

    /* Social Icons */
    .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #f8f9fa;
        color: var(--color-navy);
        transition: all 0.3s ease;
        margin: 0 5px;
        text-decoration: none;
    }
    .social-link:hover {
        background: var(--color-teal);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(22, 160, 133, 0.3);
    }

    /* Form Styles */
    .form-card {
        background: white;
        border-radius: 20px;
        border: none;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .form-header {
        background: var(--color-navy);
        color: white;
        padding: 25px;
        border-bottom: 4px solid var(--color-teal);
    }
    .form-control, .form-select {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #edf2f7;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
        background-color: white;
        border-color: var(--color-teal);
        box-shadow: 0 0 0 4px rgba(22, 160, 133, 0.1);
    }
    .form-label {
        font-weight: 600;
        color: var(--color-navy);
        font-size: 0.9rem;
        margin-bottom: 8px;
    }
    
    .btn-teal {
        background-color: var(--color-teal);
        color: white;
        border: none;
        border-radius: 10px;
        padding: 12px 25px;
        transition: all 0.3s ease;
        font-weight: 600;
    }
    .btn-teal:hover {
        background-color: #12876f;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(22, 160, 133, 0.3);
    }

    /* Sidebar Cards */
    .sidebar-card {
        border-radius: 16px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        overflow: hidden;
        margin-bottom: 30px;
    }
    .sidebar-header {
        padding: 20px;
        color: white;
    }
    .sidebar-header.bg-hours { background: var(--color-teal); }
    .sidebar-header.bg-emergency { background: #e74c3c; }
    
    .hours-list li {
        padding: 12px 0;
        border-bottom: 1px dashed #edf2f7;
        color: #4a5568;
    }
    .hours-list li:last-child {
        border-bottom: none;
    }

    /* Map Container */
    .map-container-wrapper {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        background: white;
    }
    .map-container {
        position: relative;
        overflow: hidden;
        height: 450px;
    }
    .map-container iframe {
        border: none;
        width: 100%;
        height: 100%;
    }
    .map-info-bar {
        background: var(--color-navy);
        color: white;
        padding: 20px 30px;
    }

    /* Accordion FAQ */
    .accordion-item {
        border: 1px solid #edf2f7;
        border-radius: 12px !important;
        margin-bottom: 15px;
        overflow: hidden;
        background: white;
    }
    .accordion-button {
        padding: 20px;
        font-weight: 600;
        color: var(--color-navy);
        background: white;
        box-shadow: none !important;
    }
    .accordion-button:not(.collapsed) {
        background-color: var(--color-teal-light);
        color: var(--color-teal);
    }
    .accordion-button::after {
        filter: brightness(0.5);
    }
    .accordion-body {
        padding: 20px;
        color: #6c757d;
        line-height: 1.6;
    }

    /* Animations */
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease-out;
    }
    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    .is-invalid {
        border-color: #dc3545 !important;
        background-color: #fff8f8 !important;
    }
    .is-valid {
        border-color: #198754 !important;
        background-color: #f8fff9 !important;
    }
</style>

<!-- Hero Section -->
<div class="hero-header text-center">
    <div class="container position-relative" style="z-index: 2;">
        <h1 class="display-4 fw-bold text-white mb-3">Kontak Kami</h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 600px;">Kami siap membantu Anda. Hubungi kami untuk informasi layanan, pendaftaran, atau layanan gawat darurat.</p>
    </div>
</div>

<div class="container" style="margin-top: -50px; position: relative; z-index: 3;">
    <div class="row g-4 mb-5 reveal active">
        <!-- Contact Information -->
        <div class="col-lg-4">
            <div class="feature-card">
                <div class="icon-wrapper">
                    <i class="fas fa-map-marker-alt fa-2x"></i>
                </div>
                <h5 class="fw-bold" style="color: var(--color-navy);">Alamat Kami</h5>
                <p class="text-muted mt-3 mb-0">
                   Jl. Aur No.8 Ujung Gurun <br>
                   Kota Padang, Sumatera Barat 25114
                </p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="feature-card">
                <div class="icon-wrapper">
                    <i class="fas fa-phone-alt fa-2x"></i>
                </div>
                <h5 class="fw-bold" style="color: var(--color-navy);">Telepon</h5>
                <p class="text-muted mt-3 mb-0">
                    (0751) 31938<br>
                    (0751) 33854<br>
                    <span class="d-inline-block mt-2 px-3 py-1 bg-danger text-white rounded-pill fw-bold small">IGD: 119</span>
                </p>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="feature-card">
                <div class="icon-wrapper">
                    <i class="fas fa-envelope fa-2x"></i>
                </div>
                <h5 class="fw-bold" style="color: var(--color-navy);">Email & Sosial Media</h5>
                <p class="text-muted mt-3 mb-3">
                    rskbropanasuripadang@gmail.com
                </p>
                <div>
                    <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-8 reveal">
            <!-- Contact Form -->
            <div class="form-card">
                <div class="form-header">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-paper-plane me-2"></i>Kirim Pesan Langsung</h4>
                    <p class="mb-0 text-white-50 mt-1 small">Isi formulir di bawah ini dan tim kami akan segera menghubungi Anda.</p>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                        @csrf
                        <!-- Honeypot Field -->
                        <div style="display: none;">
                            <label for="website_url">Leave this field empty</label>
                            <input type="text" name="website_url" id="website_url" tabindex="-1" autocomplete="off">
                        </div>
                        
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" 
                                    value="{{ old('name') }}" placeholder="Masukkan nama Anda" required>
                                <div class="invalid-feedback">Harap isi nama lengkap</div>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Aktif <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" 
                                    value="{{ old('email') }}" placeholder="contoh@email.com" required>
                                <div class="invalid-feedback">Harap isi email yang valid</div>
                            </div>
                        </div>
                        
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Nomor Telepon / WA</label>
                                <input type="tel" class="form-control" id="phone" name="phone" 
                                    value="{{ old('phone') }}" placeholder="08xx-xxxx-xxxx">
                            </div>
                            <div class="col-md-6">
                                <label for="subject" class="form-label">Topik Pesan <span class="text-danger">*</span></label>
                                <select class="form-select" id="subject" name="subject" required>
                                    <option value="" disabled selected>-- Pilih Topik --</option>
                                    <option value="Janji Temu Dokter" {{ old('subject') == 'JTM' ? 'selected' : '' }}>Janji Temu Dokter</option>
                                    <option value="Informasi Layanan" {{ old('subject') == 'IL'? 'selected' : '' }}>Informasi Layanan</option>
                                    <option value="Keluhan & Saran" {{ old('subject') == 'Kesan' ? 'selected' : '' }}>Keluhan & Saran</option>
                                    <option value="Kemitraan" {{ old('subject') == 'Kemitraan' ? 'selected' : '' }}>Kemitraan Asuransi/Perusahaan</option>
                                    <option value="Lainnya" {{ old('subject') == 'Lainnya' ? 'selected' : '' }}>Pertanyaan Lainnya</option>
                                </select>
                                <div class="invalid-feedback">Harap pilih topik pesan</div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="message" class="form-label">Isi Pesan <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" name="message" rows="5" 
                                    placeholder="Jelaskan kebutuhan atau pertanyaan Anda di sini..." required>{{ old('message') }}</textarea>
                            <div class="invalid-feedback">Harap isi pesan</div>
                        </div>
                        
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-teal btn-lg" id="submitBtn">
                                <i class="fas fa-paper-plane me-2"></i>Kirim Pesan Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4 reveal">
            <!-- Operating Hours -->
            <div class="sidebar-card">
                <div class="sidebar-header bg-hours">
                    <h5 class="mb-0 fw-bold"><i class="far fa-clock me-2"></i>Jam Operasional</h5>
                </div>
                <div class="card-body p-4 bg-white">
                    <ul class="list-unstyled hours-list mb-0">
                        <li class="d-flex justify-content-between align-items-center">
                            <span>Senin - Jumat</span>
                            <span class="fw-bold" style="color: var(--color-navy);">07:00 - 21:00</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <span>Sabtu</span>
                            <span class="fw-bold" style="color: var(--color-navy);">07:00 - 18:00</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center">
                            <span>Minggu & Libur</span>
                            <span class="fw-bold" style="color: var(--color-navy);">08:00 - 16:00</span>
                        </li>
                        <li class="d-flex justify-content-between align-items-center bg-light p-3 rounded-3 mt-3">
                            <span class="fw-bold text-dark">IGD & Apotek</span>
                            <span class="badge bg-teal p-2" style="background-color: var(--color-teal); color: white;">Buka 24 Jam</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Emergency Contact -->
            <div class="sidebar-card">
                <div class="sidebar-header bg-emergency text-center py-4">
                    <div class="bg-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-ambulance fa-2x text-danger"></i>
                    </div>
                    <h4 class="mb-1 fw-bold">Gawat Darurat</h4>
                    <h2 class="display-5 fw-bold mb-0 text-white">119</h2>
                </div>
                <div class="card-body p-4 bg-white text-center">
                    <p class="text-muted mb-4">Layanan ambulans dan penanganan gawat darurat siaga 24 jam penuh.</p>
                    <a href="tel:119" class="btn btn-outline-danger w-100 rounded-pill fw-bold py-2">
                        <i class="fas fa-phone-alt me-2"></i>Panggil Ambulans
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="row mt-5 pt-5 reveal">
        <div class="col-12 text-center mb-5">
            <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Lokasi Kami</h6>
            <h2 class="section-title">Kunjungi Rumah Sakit</h2>
        </div>
        
        <div class="col-12">
            <div class="map-container-wrapper">
                <div class="map-info-bar d-flex flex-wrap justify-content-between align-items-center">
                    <div class="mb-3 mb-md-0 d-flex align-items-center">
                        <i class="fas fa-map-marked-alt fa-2x me-3 text-white-50"></i>
                        <div>
                            <h5 class="mb-1 fw-bold text-white">RSKB Ropanasuri</h5>
                            <p class="mb-0 text-white-50 small">Jl. Aur No.8, Ujung Gurun, Kec. Padang Bar., Kota Padang</p>
                        </div>
                    </div>
                    <a href="https://www.openstreetmap.org/?#map=19/-0.935368/100.359233" 
                       class="btn btn-light rounded-pill fw-bold text-navy px-4" style="color: var(--color-navy);" target="_blank">
                        <i class="fas fa-directions me-2"></i>Buka di Peta
                    </a>
                </div>
                <div class="map-container">
                    <iframe 
                        src="https://www.openstreetmap.org/export/embed.html?bbox=100.35746276378633%2C-0.9366768575757999%2C100.36100327968599%2C-0.9340593704145732&amp;layer=mapnik"
                        width="100%" 
                        height="450" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="row mt-5 pt-5 reveal">
        <div class="col-lg-8 mx-auto">
            <div class="text-center mb-5">
                <h6 class="text-uppercase fw-bold mb-2" style="color: var(--color-teal); letter-spacing: 2px;">Bantuan</h6>
                <h2 class="section-title">Pertanyaan Umum (FAQ)</h2>
            </div>
            
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            <i class="fas fa-calendar-check me-3" style="color: var(--color-teal);"></i> Bagaimana cara membuat janji temu dengan dokter?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Anda dapat membuat janji temu melalui tiga cara: (1) Menghubungi nomor telepon kami di (0751) 31938, (2) Menggunakan formulir kontak di halaman ini dengan memilih topik "Janji Temu Dokter", atau (3) Datang langsung ke bagian pendaftaran rumah sakit.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            <i class="fas fa-id-card me-3" style="color: var(--color-teal);"></i> Apakah rumah sakit melayani pasien BPJS?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Ya, kami melayani pasien BPJS Kesehatan. Pastikan Anda membawa Kartu BPJS aktif, KTP, dan surat rujukan berjenjang dari Fasilitas Kesehatan Tingkat Pertama (Faskes 1) untuk pelayanan rawat jalan. Untuk kasus kegawatdaruratan di IGD, rujukan tidak diperlukan.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            <i class="fas fa-clock me-3" style="color: var(--color-teal);"></i> Berapa lama estimasi waktu tunggu untuk pelayanan IGD?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Pelayanan di Instalasi Gawat Darurat (IGD) menggunakan sistem triase (berdasarkan tingkat keparahan/kegawatan pasien, bukan urutan kedatangan). Pasien dengan kondisi mengancam nyawa akan langsung mendapatkan penanganan pertama (0 menit waktu tunggu). Untuk kondisi non-gawat, waktu tunggu menyesuaikan antrean prioritas.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Scroll reveal animation
    const reveals = document.querySelectorAll(".reveal");
    function revealOnScroll() {
        for (let i = 0; i < reveals.length; i++) {
            const windowHeight = window.innerHeight;
            const elementTop = reveals[i].getBoundingClientRect().top;
            const elementVisible = 100;
            if (elementTop < windowHeight - elementVisible) {
                reveals[i].classList.add("active");
            }
        }
    }
    window.addEventListener("scroll", revealOnScroll);
    revealOnScroll(); // Trigger on load

    // Form Handling
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic form validation
            if (!contactForm.checkValidity()) {
                e.stopPropagation();
                contactForm.classList.add('was-validated');
                return;
            }
            
            // Show loading state
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin me-2"></i>Mengirim Pesan...';
            submitBtn.disabled = true;
            
            const formData = new FormData(contactForm);
            
            fetch('{{ route("contact.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Terkirim!',
                        text: data.message || 'Pesan Anda berhasil dikirim. Kami akan segera merespon.',
                        confirmButtonColor: '#16a085',
                        confirmButtonText: 'Tutup',
                        customClass: {
                            confirmButton: 'btn btn-teal rounded-pill px-4'
                        },
                        buttonsStyling: false
                    }).then(() => {
                        contactForm.reset();
                        contactForm.classList.remove('was-validated');
                        inputs.forEach(input => input.classList.remove('is-valid'));
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: data.message || 'Terjadi kesalahan saat mengirim pesan.',
                        confirmButtonColor: '#e74c3c',
                        confirmButtonText: 'Coba Lagi'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan Jaringan',
                    text: 'Tidak dapat terhubung ke server. Silakan periksa koneksi Anda.',
                    confirmButtonColor: '#e74c3c'
                });
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });

        // Real-time validation styling
        const inputs = contactForm.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (this.required && !this.value) {
                    this.classList.add('is-invalid');
                    this.classList.remove('is-valid');
                } else if (this.value) {
                    if (this.checkValidity()) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.add('is-invalid');
                        this.classList.remove('is-valid');
                    }
                }
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid') && this.checkValidity()) {
                    this.classList.remove('is-invalid');
                }
            });
        });

        // Phone number formatting
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 4) {
                    value = value.substring(0, 4) + '-' + value.substring(4);
                }
                if (value.length > 9) {
                    value = value.substring(0, 9) + '-' + value.substring(9, 13);
                }
                e.target.value = value;
            });
        }
    }
});
</script>
@endsection