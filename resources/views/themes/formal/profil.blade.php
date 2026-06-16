@extends('themes.formal.layouts.app')

@section('content')
    
    <!-- Page Header (Breadcrumb Section) -->
    <section class="bg-emerald-950 text-white py-12 px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1590075865003-e48277adc558')] bg-cover bg-center mix-blend-overlay"></div>
        <div class="relative max-w-7xl mx-auto text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-2xl md:text-3xl font-bold tracking-tight">Profil Pesantren</h2>
                <p class="text-emerald-300 text-xs mt-1">Mengenal lebih dekat sejarah, visi misi, dan kepengurusan ma'had</p>
            </div>
            <div class="text-xs text-emerald-400 bg-emerald-900/50 px-4 py-2 rounded border border-emerald-800/60">
                <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a> 
                <span class="mx-2 text-gray-500">/</span> 
                <span class="text-white">Profil</span>
            </div>
        </div>
    </section>

    <!-- Sejarah / Tentang Kami -->
    <section class="py-16 px-4 bg-white">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-7">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-2">Ikhtisar Sejarah</span>
                <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 tracking-tight">Perjalanan Pesantren Darussalam</h3>
                <div class="w-12 h-1 bg-emerald-600 mb-6"></div>
                <div class="space-y-4 text-sm md:text-base text-gray-600 leading-relaxed font-light">
                    <!-- RENDER SEJARAH TEKS SECARA DINAMIS -->
                    @if(isset($profilSettings['sejarah_teks']) && !empty($profilSettings['sejarah_teks']))
                        {!! nl2br(e($profilSettings['sejarah_teks'])) !!}
                    @else
                        <p>
                            Pesantren Darussalam didirikan pada tahun 2010 oleh Yayasan Islam Darussalam di atas tanah wakaf seluas 2 hektar di Kota Makassar. Berawal dari sebuah mushola kecil dan beberapa santri mukim, ma'had ini terus berkembang secara konsisten dari tahun ke tahun menjadi lembaga pendidikan Islam yang terintegrasi.
                        </p>
                        <p>
                            Dalam perkembangannya, kami memadukan khazanah keilmuan Islam tradisional (*Kitab Kuning*) dengan kurikulum nasional. Fokus utama kami adalah melahirkan santri yang tangguh secara spiritual, mandiri secara ekonomi, dan siap berkontribusi nyata bagi masyarakat luas di era globalisasi ini.
                        </p>
                    @endif
                </div>
            </div>
            
            <!-- Foto Dokumentasi Samping Sejarah -->
            <div class="lg:col-span-5 grid grid-cols-2 gap-4">
                @if(isset($profilSettings['sejarah_foto']) && !empty($profilSettings['sejarah_foto']))
                    <div class="col-span-2 bg-slate-50 border border-slate-100 rounded-xl overflow-hidden shadow-sm h-72">
                        <img src="{{ asset('storage/' . $profilSettings['sejarah_foto']) }}" class="w-full h-full object-cover" alt="Dokumentasi Sejarah Ma'had">
                    </div>
                @else
                    <!-- Fallback Gambar Statis Jika Kosong -->
                    <div class="bg-gray-100 rounded-lg h-48 flex items-center justify-center text-gray-400 border border-gray-200">
                        <i class="fa-regular fa-image text-3xl"></i>
                    </div>
                    <div class="bg-gray-100 rounded-lg h-48 flex items-center justify-center text-gray-400 border border-gray-200 mt-6">
                        <i class="fa-regular fa-image text-3xl"></i>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="py-16 px-4 bg-gray-50 border-t border-b border-gray-100">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-1">Arah Langkah</span>
                <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Visi &amp; Misi</h3>
                <div class="w-12 h-1 bg-emerald-600 mx-auto mt-3"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-stretch">
                <!-- Visi Dinamis -->
                <div class="md:col-span-5 bg-emerald-900 text-white p-8 rounded-xl shadow-md flex flex-col justify-center">
                    <span class="text-xs font-bold tracking-widest uppercase text-emerald-400 mb-2">Visi</span>
                    <p class="text-base md:text-lg font-medium leading-relaxed italic">
                        "{{ $profilSettings['visi_teks'] ?? 'Terwujudnya lembaga pendidikan Islam model yang unggul dalam melahirkan generasi bertakwa, menguasai ilmu syar\'i, berkepribadian mulia, serta tanggap terhadap tuntutan zaman.' }}"
                    </p>
                </div>
                
                <!-- Misi Dinamis -->
                <div class="md:col-span-7 bg-white p-8 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-center">
                    <span class="text-xs font-bold tracking-widest uppercase text-emerald-700 mb-Block pb-2 border-b border-slate-100 mb-4 block">Misi Pesantren</span>
                    
                    @if(isset($profilSettings['visi_misi_teks']) && !empty($profilSettings['visi_misi_teks']))
                        <div class="text-sm text-gray-600 font-light leading-relaxed whitespace-pre-line space-y-2">
                            {!! nl2br(e($profilSettings['visi_misi_teks'])) !!}
                        </div>
                    @else
                        <ul class="space-y-3 text-sm text-gray-600 font-light">
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check-to-slot text-emerald-600 mt-1 text-xs shrink-0"></i>
                                <span>Menyelenggarakan sistem pendidikan kepesantrenan berasrama yang disiplin, aman, dan kondusif untuk menghafal Al-Qur'an.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check-to-slot text-emerald-600 mt-1 text-xs shrink-0"></i>
                                <span>Menanamkan pemahaman aqidah yang shahihah dan akhlakul karimah dalam kehidupan sehari-hari.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check-to-slot text-emerald-600 mt-1 text-xs shrink-0"></i>
                                <span>Mengembangkan potensi akademik, kepemimpinan, dan kecakapan hidup (*life skills*) para santri secara komprehensif.</span>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Struktur Organisasi -->
    <section class="py-16 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-700 block mb-1">Manajemen Ma'had</span>
                <h3 class="text-2xl font-bold text-gray-900 tracking-tight">Struktur Organisasi</h3>
                <div class="w-12 h-1 bg-emerald-600 mx-auto mt-3"></div>
            </div>

            <!-- Render Bagan Struktur Organisasi Dinamis -->
            <div class="max-w-4xl mx-auto flex flex-col items-center justify-center">
                @if(isset($profilSettings['struktur_pengurus']) && !empty($profilSettings['struktur_pengurus']))
                    <div class="w-full bg-white border border-slate-200/60 p-3 rounded-2xl shadow-md transition hover:shadow-lg">
                        <img src="{{ asset('storage/' . $profilSettings['struktur_pengurus']) }}" alt="Bagan Struktur Pengurus" class="w-full h-auto rounded-xl object-contain">
                    </div>
                @else
                    <div class="w-full max-w-4xl bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-8 flex flex-col items-center justify-center text-center h-80 shadow-inner">
                        <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-800 text-2xl mb-4">
                            <i class="fa-solid fa-sitemap"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 mb-1 text-sm md:text-base">Bagan Struktur Pengurus &amp; Asatidzah</h4>
                        <p class="text-xs text-gray-500 max-w-md font-light leading-relaxed">
                            Bagan interaktif atau gambar struktur organisasi yang diunggah oleh Admin Pesantren melalui CMS belum diisi.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- TOGGLE FITUR: STATISTIK DIGITAL (Menggunakan saklar download center bawaan) --}}
    @if($setting->feature_download)
    <section class="py-12 bg-emerald-900 text-white px-4">
        <div class="max-w-7xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="p-4 border-r border-emerald-800/40 last:border-0">
                <h3 class="text-3xl font-extrabold text-emerald-300">350+</h3>
                <p class="text-xs text-gray-300 uppercase font-semibold mt-1 tracking-wider">Santri Aktif</p>
            </div>
            <div class="p-4 border-r border-emerald-800/40 last:border-0">
                <h3 class="text-3xl font-extrabold text-emerald-300">45+</h3>
                <p class="text-xs text-gray-300 uppercase font-semibold mt-1 tracking-wider">Asatidzah</p>
            </div>
            <div class="p-4 border-r border-emerald-800/40 last:border-0">
                <h3 class="text-3xl font-extrabold text-emerald-300">12</h3>
                <p class="text-xs text-gray-300 uppercase font-semibold mt-1 tracking-wider">Fasilitas Utama</p>
            </div>
            <div class="p-4 last:border-0">
                <h3 class="text-3xl font-extrabold text-emerald-300">1,200+</h3>
                <p class="text-xs text-gray-300 uppercase font-semibold mt-1 tracking-wider">Alumni Tersebar</p>
            </div>
        </div>
    </section>
    @endif
@endsection