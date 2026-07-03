@extends('layouts.app')

@section('title', 'Kebijakan Privasi')

@section('content')
<div class="legal-page bg-light pb-5">
    <!-- Header Section -->
    <section class="legal-header py-5 bg-navy text-white position-relative overflow-hidden">
        <div class="bg-shape"></div>
        <div class="container position-relative z-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none hover-teal">Beranda</a></li>
                    <li class="breadcrumb-item active text-white">Kebijakan Privasi</li>
                </ol>
            </nav>
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-teal-light text-teal mb-3 px-3 py-2 rounded-pill fw-medium"><i class="fas fa-shield-alt me-2"></i>Legal & Privasi</span>
                    <h1 class="display-5 fw-bold mb-3">Kebijakan Privasi</h1>
                    <p class="lead text-white-50 mb-0">Komitmen kami dalam menjaga keamanan data dan privasi Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Document Content -->
    <section class="legal-content py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 rounded-4 shadow-sm bg-white overflow-hidden">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-flex align-items-center mb-4 text-muted small pb-4 border-bottom">
                                <i class="fas fa-calendar-check text-teal me-2"></i>
                                <span>Pembaruan Terakhir: <strong>{{ date('d F Y') }}</strong></span>
                            </div>

                            <div class="legal-text text-muted">
                                <h4>1. Pendahuluan</h4>
                                <p>Selamat datang di Rumah Sakit Khusus Bedah (RSKB) Ropanasuri. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, mengungkapkan, dan melindungi informasi pribadi Anda saat Anda menggunakan situs web dan layanan kami.</p>

                                <h4>2. Informasi yang Kami Kumpulkan</h4>
                                <p>Kami dapat mengumpulkan informasi pribadi Anda, termasuk namun tidak terbatas pada:</p>
                                <ul>
                                    <li>Data Identitas (Nama lengkap, NIK, tanggal lahir)</li>
                                    <li>Data Kontak (Alamat email, nomor telepon, alamat domisili)</li>
                                    <li>Data Kesehatan (Riwayat medis, hasil laboratorium, resep dokter) yang Anda bagikan untuk keperluan layanan konsultasi dan homecare</li>
                                    <li>Data Teknis (Alamat IP, jenis peramban, waktu akses) saat Anda menjelajahi situs kami</li>
                                </ul>

                                <h4>3. Penggunaan Informasi</h4>
                                <p>Informasi yang dikumpulkan digunakan semata-mata untuk:</p>
                                <ul>
                                    <li>Menyediakan layanan medis, administrasi, dan homecare yang Anda minta</li>
                                    <li>Memproses pendaftaran dan penjadwalan janji temu dokter</li>
                                    <li>Berkomunikasi dengan Anda mengenai layanan, hasil pemeriksaan, atau pembaruan sistem</li>
                                    <li>Meningkatkan kualitas layanan dan pengalaman pengguna di situs web kami</li>
                                </ul>

                                <h4>4. Berbagi dan Pengungkapan Informasi</h4>
                                <p>Kami tidak akan menjual atau menyewakan informasi pribadi Anda kepada pihak ketiga. Kami hanya dapat membagikan informasi Anda kepada:</p>
                                <ul>
                                    <li>Tenaga medis internal dan spesialis yang merawat Anda</li>
                                    <li>Otoritas hukum jika diwajibkan oleh undang-undang atau perintah pengadilan</li>
                                </ul>

                                <h4>5. Keamanan Data</h4>
                                <p>Kami menerapkan standar keamanan teknis dan organisasi yang ketat untuk melindungi data Anda dari akses, pengungkapan, atau modifikasi yang tidak sah. Protokol enkripsi digunakan dalam transfer data komunikasi sensitif.</p>

                                <h4>6. Hak-Hak Anda</h4>
                                <p>Anda memiliki hak untuk meminta akses, koreksi, atau penghapusan data pribadi Anda yang ada di sistem kami, sejauh diperbolehkan oleh peraturan medis dan hukum yang berlaku di Indonesia.</p>

                                <h4>7. Perubahan Kebijakan</h4>
                                <p>RSKB Ropanasuri berhak memperbarui Kebijakan Privasi ini sewaktu-waktu. Perubahan akan segera berlaku setelah dipublikasikan di halaman ini.</p>
                                
                                <div class="alert bg-teal-light text-navy border-0 rounded-3 mt-5 p-4">
                                    <h5 class="fw-bold mb-2"><i class="fas fa-headset text-teal me-2"></i>Hubungi Kami</h5>
                                    <p class="mb-0 small">Jika Anda memiliki pertanyaan terkait Kebijakan Privasi ini, silakan hubungi kami melalui halaman <a href="{{ route('contact') }}" class="text-teal fw-bold hover-teal">Kontak</a> atau email ke privacy@rskbropanasuri.com.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
/* Theme Variables */
:root {
    --color-navy: #0F3460;
    --color-teal: #16a085;
    --color-teal-light: #e8f6f3;
}

.text-navy { color: var(--color-navy) !important; }
.text-teal { color: var(--color-teal) !important; }
.bg-navy { background-color: var(--color-navy) !important; }
.bg-teal-light { background-color: var(--color-teal-light) !important; }
.hover-teal:hover { color: var(--color-teal) !important; transition: 0.3s; }

/* Header Elements */
.legal-header {
    background: linear-gradient(135deg, var(--color-navy) 0%, #1a4a82 100%);
}
.bg-shape {
    position: absolute;
    top: -50%;
    right: -10%;
    width: 600px;
    height: 600px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(22,160,133,0.15) 0%, rgba(0,0,0,0) 70%);
    z-index: 1;
}

/* Typography & Content Layout */
.legal-text {
    line-height: 1.8;
    font-size: 1.05rem;
    color: #4a5568;
}
.legal-text h4 {
    color: var(--color-navy);
    font-weight: 700;
    margin-top: 2.5rem;
    margin-bottom: 1rem;
    font-size: 1.25rem;
}
.legal-text h4:first-of-type {
    margin-top: 0;
}
.legal-text p {
    text-align: justify;
    margin-bottom: 1.25rem;
}
.legal-text ul {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}
.legal-text li {
    margin-bottom: 0.5rem;
}
.legal-text li::marker {
    color: var(--color-teal);
    font-weight: bold;
}
</style>
@endsection
