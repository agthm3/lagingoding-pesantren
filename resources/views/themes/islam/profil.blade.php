@extends('themes.islam.layouts.app')

@section('content')
    <section class="bg-emerald-950 text-white py-16 px-4 relative overflow-hidden text-center">
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1542838132-92c53300491e')] bg-cover bg-center mix-blend-overlay"></div>
        <div class="relative max-w-4xl mx-auto z-10">
            <h2 class="font-serif text-2xl md:text-4xl font-bold tracking-wide text-white">Tarikh & Profil Ma'had</h2>
            <p class="text-amber-400 font-serif italic text-xs md:text-sm mt-2">Mengenal sanad silsilah, arah pandang, dan riwayat khidmah pesantren</p>
            <div class="inline-flex items-center gap-2 mt-4 text-[11px] text-emerald-300 bg-emerald-900/60 px-4 py-1.5 rounded-full border border-emerald-800/60">
                <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a> 
                <span class="text-emerald-700">/</span> 
                <span class="text-white">Profil Ma'had</span>
            </div>
        </div>
    </section>

    <!-- SEKSI 1: NAPAK TILAS SEJARAH -->
    <section class="py-20 px-4 bg-white relative">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-7">
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-600 block">Napak Tilas</span>
                    <div class="w-8 h-px bg-amber-500"></div>
                </div>
                <h3 class="font-serif text-2xl md:text-3xl font-bold text-emerald-950 mb-6 tracking-tight">Sejarah Berdirinya Ma'had</h3>
                <div class="space-y-4 text-sm md:text-base text-gray-600 leading-relaxed font-light">
                    @if(isset($profilSettings['sejarah_teks']) && !empty($profilSettings['sejarah_teks']))
                        {!! nl2br(e($profilSettings['sejarah_teks'])) !!}
                    @else
                        <p>
                            Pondok Pesantren Darussalam dirintis pertama kali oleh para alim ulama lokal bersama Yayasan Islam Darussalam di atas tanah wakaf seluas 2 hektar di wilayah Kota Makassar. Bermodalkan bangunan mushola kayu sederhana, ma'had ini diniatkan sebagai pusat benteng pertahanan aqidah umat di wilayah Indonesia Timur.
                        </p>
                        <p>
                            Seiring berjalannya waktu, pesantren ini terus istiqomah mempertahankan tradisi keilmuan salaf melalui metode *sorogan* dan *bandongan*, tanpa menutup mata dari integrasi sistem pendidikan madrasah formal. Langkah ini diambil guna melahirkan mutafaqqih fiddin yang adaptif namun kokoh memegang prinsip ulama salafus shalih.
                        </p>
                    @endif
                </div>
            </div>
            
            <!-- Foto Dokumentasi Samping Sejarah -->
            <div class="lg:col-span-5 grid grid-cols-12 gap-4">
                <div class="col-span-12 bg-emerald-900/5 border border-emerald-950/10 rounded-2xl overflow-hidden relative shadow-inner flex items-center justify-center min-h-[260px]">
                    @if(isset($profilSettings['sejarah_foto']) && !empty($profilSettings['sejarah_foto']))
                        <img src="{{ asset('storage/' . $profilSettings['sejarah_foto']) }}" class="w-full h-full object-cover" alt="Dokumentasi Sejarah Ma'had">
                    @elseif(isset($profilSettings['sambutan_foto']) && !empty($profilSettings['sambutan_foto']))
                        <!-- Fallback ke foto pengasuh jika foto sejarah belum diunggah -->
                        <img src="{{ asset('storage/' . $profilSettings['sambutan_foto']) }}" class="w-full h-full object-cover" alt="Foto Pengasuh">
                        <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-emerald-950/80 p-4 text-center">
                            <h4 class="text-white font-serif text-sm font-bold">{{ $profilSettings['sambutan_nama'] ?? '' }}</h4>
                            <p class="text-amber-400 text-[10px] uppercase tracking-wider mt-0.5">{{ $profilSettings['sambutan_jabatan'] ?? '' }}</p>
                        </div>
                    @else
                        <div class="h-64 flex flex-col items-center justify-center text-emerald-900/20">
                            <i class="fa-regular fa-image text-4xl mb-2"></i>
                            <span class="text-xs font-semibold">Foto Dokumentasi Belum Diatur</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- SEKSI 2: KHITTAH VISI & MISI MA'HAD -->
    <section class="py-20 px-4 bg-[#f4f2e9] border-t border-b border-amber-500/10 relative">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-600 block mb-1">Ghayah & Ghars (Tujuan & Ikhtiar)</span>
                <h3 class="font-serif text-2xl font-bold text-emerald-950 tracking-wide">Khittah Visi & Misi</h3>
                <div class="w-16 h-0.5 bg-amber-500 mx-auto mt-3"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-stretch">
                <!-- BOX CONTAINER VISI -->
                <div class="md:col-span-5 bg-gradient-to-br from-emerald-950 to-emerald-900 text-white p-8 rounded-2xl shadow-lg border-2 border-amber-500/30 flex flex-col justify-center relative">
                    <div class="absolute -right-4 -top-4 w-12 h-12 bg-amber-500 rounded-full flex items-center justify-center text-emerald-950 text-xl font-bold border-2 border-white">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <span class="text-xs font-serif tracking-widest uppercase text-amber-400 mb-3 font-semibold">Visi Ma'had</span>
                    <p class="font-serif text-sm md:text-base leading-relaxed italic text-gray-100">
                        "{{ $profilSettings['visi_teks'] ?? 'Menjadi pusat pendidikan Islam aswaja terdepan dalam mencetak generasi mutafaqqih fiddin, berwawasan luas, berakhlaqul karimah, serta berkhidmah nyata bagi kejayaan umat.' }}"
                    </p>
                </div>
                
                <!-- BOX CONTAINER MISI -->
                <div class="md:col-span-7 bg-white p-8 rounded-2xl shadow-sm border border-emerald-900/5 flex flex-col justify-center">
                    <span class="text-xs font-bold tracking-widest uppercase text-emerald-950 mb-5 block border-b border-gray-100 pb-2">Misi Pesantren</span>
                    
                    @if(isset($profilSettings['visi_misi_teks']) && !empty($profilSettings['visi_misi_teks']))
                        <!-- Merender Poin Misi dengan format baris rapi dari textarea admin -->
                        <div class="text-xs md:text-sm text-gray-600 font-light leading-relaxed whitespace-pre-line space-y-2">
                            {!! nl2br(e($profilSettings['visi_misi_teks'])) !!}
                        </div>
                    @else
                        <ul class="space-y-4 text-xs md:text-sm text-gray-600 font-light">
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-star-of-david text-amber-500 mt-1 text-xs shrink-0"></i>
                                <span>Menyelenggarakan kajian kitab turats (kitab kuning) secara berkesinambungan dengan sanad keilmuan yang jelas.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-star-of-david text-amber-500 mt-1 text-xs shrink-0"></i>
                                <span>Menanamkan amalan thariqah aqidah Ahlussunnah wal Jama'ah an-Nahdliyah dalam naungan kedisiplinan asrama.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fa-solid fa-star-of-david text-amber-500 mt-1 text-xs shrink-0"></i>
                                <span>Membekali santri dengan penguasaan bahasa Arab resmi mutakhir serta ilmu alat (Nahwu-Sharaf) yang mumpuni.</span>
                            </li>
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- SEKSI 3: BAGAN STRUKTUR ORGANISASI -->
    <section class="py-20 px-4 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-14">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-600 block mb-1">Masyayikh & Asatidzah</span>
                <h3 class="font-serif text-2xl font-bold text-emerald-950 tracking-wide">Struktur Kepengurusan Ma'had</h3>
                <div class="w-16 h-0.5 bg-amber-500 mx-auto mt-3"></div>
            </div>

            <div class="max-w-5xl mx-auto flex flex-col items-center justify-center">
                @if(isset($profilSettings['struktur_pengurus']) && !empty($profilSettings['struktur_pengurus']))
                    <div class="w-full bg-white border border-slate-200/60 p-4 rounded-2xl shadow-md transition hover:shadow-lg">
                        <img src="{{ asset('storage/' . $profilSettings['struktur_pengurus']) }}" alt="Bagan Struktur Pengurus" class="w-full h-auto rounded-xl object-contain">
                    </div>
                @else
                    <div class="w-full max-w-4xl bg-[#fcfbf7] border-2 border-dashed border-emerald-900/20 rounded-2xl p-8 flex flex-col items-center justify-center text-center h-80 shadow-inner">
                        <div class="w-16 h-16 bg-emerald-900 rounded-full flex items-center justify-center text-amber-400 text-2xl mb-4 border border-amber-400/40 shadow">
                            <i class="fa-solid fa-sitemap"></i>
                        </div>
                        <h4 class="font-serif font-bold text-emerald-950 mb-1 text-base">Silsilah & Bagan Pengurus Pondok</h4>
                        <p class="text-xs text-gray-500 max-w-sm font-light leading-relaxed">
                            Struktur kepengurusan, dewan pengawas yayasan, serta jajaran asatidzah yang diunggah dari panel CMS Admin Pesantren belum diisi.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- TOGGLE FITUR: STATISTIK DIGITAL RESPONSIF TERHADAP FILTER PAKET DOWNLOAD CENTER (TIER 2) --}}
    @if ($setting->feature_download)
    <section class="py-14 bg-gradient-to-r from-emerald-950 to-[#051c12] text-white px-4 border-t-2 border-b-2 border-amber-500/30">
        <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="p-2 border-r border-emerald-900/40 last:border-0">
                <h3 class="font-serif text-3xl font-bold text-amber-400">420+</h3>
                <p class="text-[10px] text-gray-300 uppercase font-bold mt-1.5 tracking-widest">Santri Mukim</p>
            </div>
            <div class="p-2 border-r border-emerald-900/40 last:border-0">
                <h3 class="font-serif text-3xl font-bold text-amber-400">38</h3>
                <p class="text-[10px] text-gray-300 uppercase font-bold mt-1.5 tracking-widest">Masyayikh & Ustadz</p>
            </div>
            <div class="p-2 border-r border-emerald-900/40 last:border-0">
                <h3 class="font-serif text-3xl font-bold text-amber-400">15+</h3>
                <p class="text-[10px] text-gray-300 uppercase font-bold mt-1.5 tracking-widest">Kajian Kitab Aktif</p>
            </div>
            <div class="p-2 last:border-0">
                <h3 class="font-serif text-3xl font-bold text-amber-400">1,500+</h3>
                <p class="text-[10px] text-gray-300 uppercase font-bold mt-1.5 tracking-widest">Keluarga Alumni</p>
            </div>
        </div>
    </section>
    @endif
@endsection