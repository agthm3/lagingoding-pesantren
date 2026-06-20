@extends('themes.modern.layouts.app')

@section('content')
    <!-- Page Header (Minimalist Badge Style) -->
    <section class="max-w-7xl mx-auto px-4 pt-12">
        <div class="bg-slate-900 text-white rounded-3xl py-12 px-8 md:px-16 relative overflow-hidden shadow-inner">
            <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-teal-500/10 rounded-full blur-3xl"></div>
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <span class="text-xs font-bold text-cyan-400 tracking-widest uppercase block mb-1">Mengenal Lembaga</span>
                    <h2 class="text-2xl md:text-4xl font-black tracking-tight">Tentang Akademi Kami</h2>
                </div>
                <div class="text-xs text-slate-400 bg-white/5 px-4 py-2 rounded-xl border border-white/10 backdrop-blur-sm">
                    <a href="{{ route('home') }}" class="hover:text-white transition">Beranda</a> 
                    <span class="mx-2">/</span> 
                    <span class="text-teal-400 font-semibold">Tentang Kami</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Ikhtisar & Sejarah -->
    <section class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-teal-600 block mb-1">Latar Belakang</span>
                    <h3 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">Rekam Jejak &amp; Garis Sejarah</h3>
                </div>
                <div class="space-y-4 text-sm md:text-base text-slate-600 leading-relaxed font-light">
                    <!-- RENDER SEJARAH TEKS SECARA DINAMIS -->
                    @if(isset($profilSettings['sejarah_teks']) && !empty($profilSettings['sejarah_teks']))
                        {!! nl2br(e($profilSettings['sejarah_teks'])) !!}
                    @else
                        <p>
                            Didirikan pada tahun 2010, Pesantren Modern Darussalam lahir dari visi besar untuk menghadirkan institusi pendidikan Islam kelas dunia yang adaptif terhadap akselerasi teknologi, tanpa mengorbankan akar tradisi keilmuan syariat dan pemeliharaan adab Qur'ani.
                        </p>
                        <p>
                            Kami mentransformasi pola pengajaran asrama konvensional menjadi ekosistem belajar yang terdigitalisasi secara sehat. Fokus kami tertuju pada pembentukan karakter santri yang mandiri, kritis, fasih literasi digital, serta memiliki landasan keimanan yang kokoh untuk menjawab kebutuhan industri modern.
                        </p>
                    @endif
                </div>
            </div>
            
            <!-- Box Gambar Dokumentasi Sejarah Dinamis -->
            <div class="lg:col-span-5">
                <div class="bg-white border border-slate-200 p-4 rounded-3xl shadow-sm space-y-4">
                    <div class="h-64 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300 border border-slate-200/60 overflow-hidden">
                        @if(isset($profilSettings['sejarah_foto']) && !empty($profilSettings['sejarah_foto']))
                            <img src="{{ asset('storage/' . $profilSettings['sejarah_foto']) }}" class="w-full h-full object-cover" alt="Dokumentasi Sejarah Pesantren">
                        @else
                            <i class="fa-regular fa-image text-4xl"></i>
                        @endif
                    </div>
                    <div class="p-2 border-t border-slate-100 flex justify-between items-center text-xs text-slate-500 font-medium">
                        <span><i class="fa-solid fa-compass text-teal-500 mr-1"></i> Kampus Terpadu Makassar</span>
                        <span class="font-bold text-slate-800">Sejak 2010</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi (Layout Grid Flat Dinamis) -->
    <section class="max-w-7xl mx-auto px-4 py-12 mb-16">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-stretch">
            
            <!-- Visi Card Dinamis -->
            <div class="md:col-span-5 bg-white border border-slate-200 p-8 rounded-3xl shadow-sm flex flex-col justify-center relative overflow-hidden group hover:border-teal-500/30 transition duration-300">
                <div class="absolute -right-6 -bottom-6 text-slate-100 text-8xl font-black group-hover:text-teal-500/5 transition duration-300">
                    <i class="fa-solid fa-bullseye"></i>
                </div>
                <span class="text-[10px] font-bold tracking-widest uppercase text-teal-600 mb-2 block">Visi Strategis</span>
                <p class="text-base md:text-lg font-black leading-snug text-slate-950">
                    "{{ $profilSettings['visi_teks'] ?? 'Menjadi lembaga pendidikan Islam terpadu panutan yang melahirkan inovator masa depan dengan keunggulan kompetensi teknologi, keluhuran adab, dan kemandirian global.' }}"
                </p>
            </div>

            <!-- Misi Card Dinamis -->
            <div class="md:col-span-7 bg-slate-900 text-white p-8 rounded-3xl shadow-xl relative overflow-hidden flex flex-col justify-center">
                <span class="text-[10px] font-bold tracking-widest uppercase text-cyan-400 mb-4 block">Misi Operasional</span>
                
                @if(isset($profilSettings['visi_misi_teks']) && !empty($profilSettings['visi_misi_teks']))
                    <div class="text-xs md:text-sm text-slate-300 font-light leading-relaxed whitespace-pre-line space-y-2">
                        {!! nl2br(e($profilSettings['visi_misi_teks'])) !!}
                    </div>
                @else
                    <ul class="space-y-4 text-xs md:text-sm text-slate-300 font-light">
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-md bg-white/10 text-cyan-400 font-bold text-[10px] flex items-center justify-center shrink-0 mt-0.5">01</span>
                            <span>Menyelenggarakan tata kelola pembelajaran terintegrasi sains-teknologi modern secara berimbang dengan porsi hafalan Al-Qur'an.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-md bg-white/10 text-cyan-400 font-bold text-[10px] flex items-center justify-center shrink-0 mt-0.5">02</span>
                            <span>Membangun ekosistem asrama dua bahasa aktif (Arab - Inggris) sebagai media komunikasi harian wajib santri.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="w-5 h-5 rounded-md bg-white/10 text-cyan-400 font-bold text-[10px] flex items-center justify-center shrink-0 mt-0.5">03</span>
                            <span>Menumbuhkan inkubasi kewirausahaan digital (*digital entrepreneurship*) guna mencetak lulusan yang mandiri secara ekonomi.</span>
                        </li>
                    </ul>
                @endif
            </div>

        </div>
    </section>

    <!-- Struktur Organisasi (Render Dinamis Gambar Bagan) -->
    <section class="max-w-7xl mx-auto px-4 py-12 mb-16 border-t border-slate-200/80">
        <div class="text-center mb-10">
            <span class="text-[10px] font-bold uppercase tracking-widest text-teal-600 block mb-1">Manajemen Organisasi</span>
            <h3 class="text-2xl font-black text-slate-900 tracking-tight">Struktur配置 Manajemen Pengurus</h3>
            <div class="w-8 h-1 bg-teal-500 mx-auto mt-3 rounded-full"></div>
        </div>

        <!-- Render Struktur Organisasi Dari Database -->
        <div class="max-w-4xl mx-auto flex justify-center">
            @if(isset($profilSettings['struktur_pengurus']) && !empty($profilSettings['struktur_pengurus']))
                <div class="w-full bg-white border border-slate-200 p-3 rounded-3xl shadow-sm hover:shadow-md transition">
                    <img src="{{ asset('storage/' . $profilSettings['struktur_pengurus']) }}" alt="Bagan Manajemen Pengurus" class="w-full h-auto rounded-2xl object-contain">
                </div>
            @else
                <div class="w-full bg-white border border-slate-200 rounded-3xl p-8 flex flex-col items-center justify-center text-center h-80 shadow-sm shadow-slate-100">
                    <div class="w-12 h-12 bg-slate-900 text-cyan-400 rounded-xl flex items-center justify-center text-xl mb-4 shadow-md">
                        <i class="fa-solid fa-network-wired"></i>
                    </div>
                    <h4 class="font-bold text-slate-900 mb-1 text-sm md:text-base">Bagan Struktur Pengurus Inti</h4>
                    <p class="text-xs text-slate-400 max-w-sm font-light leading-relaxed">
                        Skema hierarki tata kelola yayasan, dewan pengawas akademik, beserta jajaran asatidzah belum diunggah oleh Administrator ke sistem CMS.
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- TOGGLE FITUR: STATISTIK TEKNO DIGITAL -->
    @if($setting->feature_download)
    <section class="max-w-7xl mx-auto px-4 py-8 mb-16 bg-slate-900 rounded-3xl text-white shadow-lg">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y divide-white/5 md:divide-y-0 md:divide-x md:divide-white/5">
            <div class="py-4 md:py-2">
                <h3 class="text-2xl md:text-3xl font-black text-cyan-400">450+</h3>
                <p class="text-[9px] text-slate-400 uppercase font-bold mt-1 tracking-widest">Santri Aktif</p>
            </div>
            <div class="py-4 md:py-2">
                <h3 class="text-2xl md:text-3xl font-black text-cyan-400">32</h3>
                <p class="text-[9px] text-slate-400 uppercase font-bold mt-1 tracking-widest">Staf Pengajar</p>
            </div>
            <div class="py-4 md:py-2">
                <h3 class="text-2xl md:text-3xl font-black text-cyan-400">14</h3>
                <p class="text-[9px] text-slate-400 uppercase font-bold mt-1 tracking-widest">Laboratorium &amp; Lab</p>
            </div>
            <div class="py-4 md:py-2">
                <h3 class="text-2xl md:text-3xl font-black text-cyan-400">1,800+</h3>
                <p class="text-[9px] text-slate-400 uppercase font-bold mt-1 tracking-widest">Ikatan Alumni</p>
            </div>
        </div>
    </section>
    @endif
@endsection