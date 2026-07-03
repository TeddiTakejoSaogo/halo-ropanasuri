@extends('layouts.app')

@section('content')
<div class="min-h-screen py-10 bg-gradient-to-br from-[#ecfdf5] via-white to-[#d1fae5]">
    <div class="container mx-auto px-4 max-w-4xl relative z-10">
        
        <!-- Tombol Kembali -->
        <a href="{{ route('chat.index') }}" class="inline-flex items-center bg-white/80 backdrop-blur-md border border-gray-200 text-ropanasuri-700 hover:bg-ropanasuri-50 hover:text-ropanasuri-900 transition px-4 py-2 rounded-full font-medium shadow-sm mb-8">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Pusat Bantuan
        </a>
        
        <!-- Kontainer Artikel Utama -->
        <article class="bg-white rounded-3xl shadow-xl overflow-hidden border border-white/50">
            
            <!-- Hero Image (Jika Ada) -->
            @if($artikel->gambar)
            <div class="w-full h-64 md:h-96 relative overflow-hidden">
                <img src="{{ asset('storage/'.$artikel->gambar) }}" alt="{{ $artikel->judul }}" class="w-full h-full object-cover object-center transform hover:scale-105 transition duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
            </div>
            @endif

            <div class="p-8 md:p-12 {{ $artikel->gambar ? '-mt-16 relative z-20 bg-white rounded-t-3xl' : '' }}">
                
                <!-- Meta Informasi -->
                <header class="mb-8">
                    <div class="flex flex-wrap items-center gap-3 mb-5">
                        <span class="bg-ropanasuri-100 text-ropanasuri-700 px-4 py-1.5 rounded-full text-sm font-semibold flex items-center">
                            <i class="fas fa-tag mr-2 text-ropanasuri-500"></i>
                            {{ $artikel->kategori ?? 'Edukasi Kesehatan' }}
                        </span>
                        <span class="text-gray-500 text-sm flex items-center font-medium">
                            <i class="far fa-calendar-alt mr-2 text-gray-400"></i>
                            {{ $artikel->published_at ? $artikel->published_at->format('d F Y') : 'Baru Saja' }}
                        </span>
                        <span class="text-gray-500 text-sm flex items-center font-medium">
                            <i class="far fa-eye mr-2 text-gray-400"></i>
                            {{ number_format($artikel->dilihat) }}x dibaca
                        </span>
                    </div>
                    
                    <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-6 leading-tight tracking-tight">
                        {{ $artikel->judul }}
                    </h1>
                    
                    @if($artikel->excerpt)
                    <!-- Kotak Intisari Panduan -->
                    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-100 p-6 rounded-2xl mb-8 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-100/50 rounded-bl-full -mr-4 -mt-4"></div>
                        <h3 class="text-emerald-800 font-bold mb-3 flex items-center text-lg">
                            <i class="fas fa-clipboard-check mr-3 text-emerald-500 text-xl"></i> Intisari Panduan
                        </h3>
                        <p class="text-emerald-900 font-medium leading-relaxed m-0 relative z-10 text-base md:text-lg">
                            {{ $artikel->excerpt }}
                        </p>
                    </div>
                    @endif
                </header>
                
                <!-- Konten Utama (Tipografi Klinis Profesional) -->
                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed font-['Inter'] 
                            prose-headings:text-ropanasuri-800 prose-headings:font-bold prose-headings:border-b-2 prose-headings:border-ropanasuri-100 prose-headings:pb-3 prose-headings:mb-6 
                            prose-h2:text-2xl prose-h3:text-xl
                            prose-a:text-ropanasuri-600 prose-a:font-semibold prose-a:no-underline hover:prose-a:underline
                            prose-strong:text-ropanasuri-800 prose-strong:bg-ropanasuri-50 prose-strong:px-1 prose-strong:rounded
                            prose-ul:list-none prose-ul:pl-0
                            prose-li:flex prose-li:items-start prose-li:mb-3 prose-li:before:content-['\\f058'] prose-li:before:font-['Font_Awesome_6_Free'] prose-li:before:font-solid prose-li:before:text-ropanasuri-500 prose-li:before:mr-3 prose-li:before:mt-1
                            prose-blockquote:border-l-4 prose-blockquote:border-amber-400 prose-blockquote:bg-amber-50 prose-blockquote:py-2 prose-blockquote:px-5 prose-blockquote:text-amber-900 prose-blockquote:rounded-r-xl prose-blockquote:not-italic
                            prose-img:rounded-2xl prose-img:shadow-lg">
                    {!! $artikel->konten !!}
                </div>
                
                <hr class="my-10 border-gray-100">

                <!-- Penjelasan Tambahan: Edukasi Perawatan Mandiri -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8 mb-10">
                    
                    <!-- Blok 1: Perawatan Mandiri -->
                    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                        <h4 class="font-bold text-blue-800 mb-3 flex items-center">
                            <div class="w-8 h-8 rounded-full bg-blue-200 flex items-center justify-center mr-3 text-blue-600">
                                <i class="fas fa-home"></i>
                            </div>
                            Perawatan Mandiri di Rumah
                        </h4>
                        <p class="text-sm text-blue-900 leading-relaxed mb-3">Untuk mempercepat proses pemulihan setelah tindakan medis, pastikan Anda memperhatikan hal-hal berikut:</p>
                        <ul class="text-sm text-blue-800 space-y-2">
                            <li class="flex items-start"><i class="fas fa-check-circle text-blue-500 mt-1 mr-2"></i> Istirahat yang cukup dan hindari aktivitas fisik berat.</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-blue-500 mt-1 mr-2"></i> Jaga area luka tetap bersih dan kering sesuai anjuran.</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-blue-500 mt-1 mr-2"></i> Konsumsi makanan bergizi tinggi protein untuk penyembuhan jaringan.</li>
                        </ul>
                    </div>

                    <!-- Blok 2: Kontrol Rutin -->
                    <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition">
                        <h4 class="font-bold text-emerald-800 mb-3 flex items-center">
                            <div class="w-8 h-8 rounded-full bg-emerald-200 flex items-center justify-center mr-3 text-emerald-600">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            Pentingnya Kontrol Rutin
                        </h4>
                        <p class="text-sm text-emerald-900 leading-relaxed mb-3">Pemantauan pasca-perawatan sangat krusial untuk mencegah komplikasi. Jangan lewatkan jadwal kontrol Anda.</p>
                        <ul class="text-sm text-emerald-800 space-y-2 mb-4">
                            <li class="flex items-start"><i class="fas fa-arrow-right text-emerald-500 mt-1 mr-2"></i> Pastikan obat dihabiskan sesuai resep dokter.</li>
                            <li class="flex items-start"><i class="fas fa-arrow-right text-emerald-500 mt-1 mr-2"></i> Catat setiap perkembangan atau keluhan yang dirasakan.</li>
                        </ul>
                        <a href="https://antrian.ropanasuri.com/informasi/jadwal-dokter" target="_blank" class="inline-block text-xs font-bold bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition">
                            Cek Jadwal Dokter <i class="fas fa-external-link-alt ml-1"></i>
                        </a>
                    </div>

                </div>
                
                <!-- Blok Panduan Darurat Pasca-Tindakan -->
                <div class="mt-12 bg-red-50 border border-red-200 rounded-2xl p-6 md:p-8 shadow-sm">
                    <h3 class="text-xl font-bold text-red-700 mb-4 flex items-center">
                        <i class="fas fa-siren-on mr-3 text-red-500 text-2xl animate-pulse"></i> Kapan Harus Segera ke Rumah Sakit?
                    </h3>
                    <p class="text-red-900 mb-4">Segera hubungi tim medis Ropanasuri atau kunjungi IGD jika Anda atau pasien mengalami kondisi berikut:</p>
                    <ul class="space-y-2 text-red-800">
                        <li class="flex items-start"><i class="fas fa-times-circle mt-1 mr-3 text-red-500"></i> Nyeri hebat yang tidak mereda dengan obat pereda nyeri.</li>
                        <li class="flex items-start"><i class="fas fa-times-circle mt-1 mr-3 text-red-500"></i> Pendarahan berlebih, pembengkakan ekstrem, atau nanah pada area luka.</li>
                        <li class="flex items-start"><i class="fas fa-times-circle mt-1 mr-3 text-red-500"></i> Demam tinggi di atas 38°C yang tidak kunjung turun.</li>
                        <li class="flex items-start"><i class="fas fa-times-circle mt-1 mr-3 text-red-500"></i> Kesulitan bernapas, nyeri dada, atau kehilangan kesadaran.</li>
                    </ul>
                    <div class="mt-6">
                        <a href="#" class="inline-flex items-center justify-center bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded-xl transition shadow-md w-full md:w-auto">
                            <i class="fas fa-phone-alt mr-2"></i> Hubungi IGD 24 Jam: (0751) 31938
                        </a>
                    </div>
                </div>
                
                <hr class="my-10 border-gray-100">

                <!-- Call to Action: Chat AI -->
                <div class="bg-gradient-to-r from-ropanasuri-600 to-emerald-600 rounded-2xl p-6 md:p-8 text-white shadow-lg flex flex-col md:flex-row items-center justify-between mt-10">
                    <div class="mb-4 md:mb-0 md:mr-6">
                        <h3 class="text-xl font-bold mb-2 flex items-center">
                            <i class="fas fa-robot mr-3 text-2xl text-yellow-300"></i> Punya Pertanyaan Medis Lainnya?
                        </h3>
                        <p class="text-ropanasuri-50 text-sm md:text-base opacity-90">
                            Halo-Ropanasuri AI siap membantu menjawab pertanyaan Anda terkait layanan rumah sakit 24 jam penuh secara otomatis.
                        </p>
                    </div>
                    <a href="{{ route('chat.index') }}" class="whitespace-nowrap bg-white text-ropanasuri-700 hover:bg-gray-50 hover:shadow-xl transition px-6 py-3 rounded-xl font-bold shadow-md">
                        Tanya AI Sekarang <i class="fas fa-paper-plane ml-2"></i>
                    </a>
                </div>

                <!-- Disclaimer Medis Resmi -->
                <footer class="mt-8 bg-yellow-50 border border-yellow-200 rounded-xl p-5 flex items-start">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-xl mt-1 mr-4"></i>
                    <div>
                        <h4 class="font-bold text-yellow-800 mb-1">Disclaimer Medis</h4>
                        <p class="text-sm text-yellow-700 leading-relaxed">
                            Artikel ini disediakan secara eksklusif oleh <strong>RSKB Ropanasuri</strong> untuk tujuan edukasi dan informasi kesehatan masyarakat. Informasi di halaman ini <strong>tidak boleh dijadikan sebagai pengganti diagnosa, perawatan, atau saran medis profesional</strong>. Konsultasikan selalu gejala Anda kepada dokter spesialis di fasilitas kesehatan terdekat.
                        </p>
                    </div>
                </footer>
            </div>
        </article>
        
        <!-- Artikel Lainnya -->
        @if(isset($artikelLainnya) && $artikelLainnya->count() > 0)
        <div class="mt-16 mb-8">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-8 flex items-center">
                <i class="fas fa-book-medical text-ropanasuri-500 mr-3"></i> Bacaan Terkait
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($artikelLainnya as $lainnya)
                <a href="{{ route('artikel.show', $lainnya->slug) }}" class="bg-white rounded-2xl shadow-md hover:shadow-2xl hover:-translate-y-1 transition duration-300 overflow-hidden flex flex-col h-full border border-gray-100 group">
                    @if($lainnya->gambar)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ asset('storage/'.$lainnya->gambar) }}" alt="{{ $lainnya->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    @endif
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-bold text-ropanasuri-600 bg-ropanasuri-50 px-2 py-1 rounded-md mb-3 inline-block uppercase tracking-wider">
                                {{ $lainnya->kategori ?? 'Kesehatan' }}
                            </span>
                            <h3 class="font-bold text-gray-900 text-lg mb-3 leading-snug group-hover:text-ropanasuri-600 transition">{{ Str::limit($lainnya->judul, 60) }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed mb-4">{{ Str::limit($lainnya->excerpt ?? strip_tags($lainnya->konten), 90) }}</p>
                        </div>
                        <span class="text-sm font-semibold text-ropanasuri-600 flex items-center group-hover:translate-x-1 transition-transform">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </span>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection