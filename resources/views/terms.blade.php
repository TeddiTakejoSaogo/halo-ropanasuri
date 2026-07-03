@extends('layouts.app')

@section('title', 'Syarat & Ketentuan')

@section('content')
<div class="legal-page bg-light pb-5">
    <!-- Header Section -->
    <section class="legal-header py-5 bg-navy text-white position-relative overflow-hidden">
        <div class="bg-shape"></div>
        <div class="container position-relative z-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50 text-decoration-none hover-teal">Beranda</a></li>
                    <li class="breadcrumb-item active text-white">Syarat & Ketentuan</li>
                </ol>
            </nav>
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-teal-light text-teal mb-3 px-3 py-2 rounded-pill fw-medium"><i class="fas fa-file-contract me-2"></i>Legal & Kebijakan</span>
                    <h1 class="display-5 fw-bold mb-3">Syarat & Ketentuan</h1>
                    <p class="lead text-white-50 mb-0">Aturan dan panduan dalam menggunakan layanan RSKB Ropanasuri.</p>
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
                                <h4>1. Penerimaan Syarat</h4>
                                <p>Dengan mengakses situs web ini dan menggunakan layanan yang disediakan oleh RSKB Ropanasuri, Anda menyetujui untuk terikat oleh Syarat dan Ketentuan ini. Jika Anda tidak menyetujui sebagian atau seluruh syarat ini, mohon untuk tidak menggunakan situs web ini.</p>

                                <h4>2. Sifat Layanan (Disclaimer Medis)</h4>
                                <p>Informasi yang disediakan di situs web ini, termasuk artikel kesehatan, layanan individual, dan informasi medis lainnya, hanya bertujuan sebagai informasi umum. <strong>Informasi ini tidak ditujukan sebagai pengganti diagnosis, konsultasi, atau perawatan medis profesional.</strong> Jangan pernah mengabaikan nasihat medis profesional atau menunda mencarinya karena sesuatu yang Anda baca di situs ini.</p>

                                <h4>3. Penggunaan Situs Web</h4>
                                <p>Anda setuju untuk menggunakan situs web ini hanya untuk tujuan yang sah dan tidak melanggar hak, membatasi, atau menghambat penggunaan orang lain atas situs ini. Tindakan yang dilarang meliputi, namun tidak terbatas pada, pelecehan, transmisi konten cabul atau ofensif, atau mengganggu alur dialog normal dalam platform ini.</p>

                                <h4>4. Pemesanan Layanan dan Homecare</h4>
                                <ul>
                                    <li>Setiap pemesanan layanan yang dilakukan melalui formulir di situs web atau via WhatsApp wajib dikonfirmasi terlebih dahulu oleh staf rumah sakit.</li>
                                    <li>Ketersediaan dokter atau layanan dapat berubah sewaktu-waktu tanpa pemberitahuan sebelumnya.</li>
                                    <li>Harga yang tercantum (termasuk diskon) dapat berubah sewaktu-waktu. Harga akhir adalah yang dikonfirmasi oleh staf kami saat Anda melakukan pendaftaran resmi.</li>
                                </ul>

                                <h4>5. Hak Kekayaan Intelektual</h4>
                                <p>Seluruh konten, merek dagang, logo, desain, dan hak kekayaan intelektual lainnya di situs web ini adalah milik RSKB Ropanasuri atau pemegang lisensi terkait. Dilarang keras mereproduksi, mendistribusikan, atau menggunakan materi tersebut tanpa izin tertulis dari pihak RSKB Ropanasuri.</p>

                                <h4>6. Batasan Tanggung Jawab</h4>
                                <p>RSKB Ropanasuri tidak bertanggung jawab atas kerugian langsung, tidak langsung, insidental, atau konsekuensial yang timbul dari penggunaan atau ketidakmampuan menggunakan situs web ini, termasuk namun tidak terbatas pada kegagalan sistem, gangguan koneksi, atau virus komputer.</p>

                                <h4>7. Hukum yang Berlaku</h4>
                                <p>Syarat dan Ketentuan ini diatur dan ditafsirkan sesuai dengan hukum Republik Indonesia. Setiap perselisihan yang timbul sehubungan dengan syarat ini akan tunduk pada yurisdiksi pengadilan di wilayah operasional RSKB Ropanasuri.</p>
                                
                                <div class="alert bg-teal-light text-navy border-0 rounded-3 mt-5 p-4">
                                    <h5 class="fw-bold mb-2"><i class="fas fa-exclamation-circle text-teal me-2"></i>Perhatian</h5>
                                    <p class="mb-0 small">Dalam keadaan darurat medis, jangan gunakan situs web atau formulir pemesanan ini. Segera hubungi Instalasi Gawat Darurat (IGD) di <strong>(021) 111-2222</strong> atau datangi fasilitas medis terdekat.</p>
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
